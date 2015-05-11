<?php if (! defined ( 'BASEPATH' ))	exit ( 'No direct script access allowed' );

/**
 * Created by PhpStorm.
 * AES加密类
 * User: 李兰非
 * Date: 14-10-8 10:46
 */
class EEncrypt
{
    private $dirty_len = 8;     //脏数据长度，因为使用了MD5校验，增加8字节伪装成sha1
    // CRYPTO_CIPHER_BLOCK_SIZE 32

    private $encoding = 'latin1';

    public function encode_aes($data, $key)
    {
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_256, '', MCRYPT_MODE_CBC, '');
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);

        mcrypt_generic_init($td, $key, $iv);

        $encrypted = mcrypt_generic($td, $data);

        mcrypt_generic_deinit($td);

        return $iv . $encrypted;
    }

    public function decode_aes($data, $key)
    {
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_256, '', MCRYPT_MODE_CBC, '');
        $iv = mb_substr($data, 0, 32, $this->encoding);

        mcrypt_generic_init($td, $key, $iv);

        $data = mb_substr($data, 32, mb_strlen($data, $this->encoding), $this->encoding);
        $data = mdecrypt_generic($td, $data);

        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);

        return trim($data);
    }

    private function dirty($len)
    {
        $o = 'yJHhjGFDbnCV04UIO5Yuop7adM3fgklzmQWEsRT986iPLqw2NertKSAZXxcvB1';

        $i = rand(0, 61-$len);

        return substr($o, $i, $len);
    }

    /*
     * 加密
     * @data:要加密的内容
     * @key:密钥
     * */
    public function encode($data, $key)
    {
        $data = $this->encode_aes($data, $key);     //AES加密

        $data = base64_encode($data);               //base64编码

        $md5 = md5($data);                          //md5校验码

        $data = str_replace('/', '_', $data);       //替换斜线
        $data = str_replace('+', '|', $data);

        $s = $this->dirty($this->dirty_len);        //脏数据

        return $s.$md5.$data;
    }

    /*
     * 解密
     * @data:要解密的内容
     * @key:密钥
     * */
    public function decode($data, $key)
    {
        $data = str_replace('_', '/', $data);
        $data = str_replace('|', '+', $data);

        $md51 = substr($data, $this->dirty_len, 32);

        $data = substr($data, 32 + $this->dirty_len);

        $md52 = md5($data);

        //var_dump($md51);
        //var_dump($md52);

        if( $md51 == $md52 )
        {
            $data = base64_decode($data);

            $data = $this->decode_aes($data, $key);
        }
        else
        {
            return FALSE;
        }

        return $data;
    }
}