<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller
{
    public function qr()
    {
        $this->load->add_package_path(APPPATH . 'third_party/PHPQRCode/');
        $this->load->library('PHPQRCode', NULL, 'qr');

        echo $this->qr->encode('a你好a!！');
    }

    public function en()
    {
        $str = '三翻四复是否{}dfasfdsafasdfdasfa{}{}{}{}';

        $zip = gzdeflate($str, 1);

        $this->load->library('EEncrypt', NULL, 'ee');

        $r1 = $this->ee->encode($str, 'aaaaa');

        $r2 = $this->ee->encode($zip, 'aaaaa');

        var_dump($str);
        var_dump($zip);
    }

    public function ca()
    {
        $this->load->driver('cache');

        $this->cache->save('aa', '11');

        var_dump($this->cache->cache_info()) ;

        var_dump($this->cache->get_metadata('aa'));

        $r = $this->cache->get('bbb', function ($id)
            {
                echo $id;
            });
    }

    public function ip()
    {
        $this->load->library('Location');

    }

    public function jsls()
    {
        $this->load->view('js-list');
    }
}
