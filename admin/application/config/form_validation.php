<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');


/*
|--------------------------------------------------------------------------
| platform-register 平台用户注册表单规则
|--------------------------------------------------------------------------
|
*/

$config = Array(
    'login/index' => Array(
        array(
            'field' => 'uid',
            'label' => lang('form_word_uid'),
            'rules' => 'trim|required|min_length[4]|max_length[20]',
            'errors' => array(
                'required' => '%s ' . lang('form_error_null'),
                'min_length' => '%s' . lang('form_error_tip_1'),
                'max_length' => '%s' . lang('form_error_tip_1')
            )
        ),
        array(
            'field' => 'password',
            'label' =>  lang('form_word_psw'),
            'rules' => 'trim|required|min_length[6]|max_length[20]',
            'errors' => array(
                'required' => '%s ' . lang('form_error_null'),
                'min_length' => '%s' . lang('form_error_tip_2'),
                'max_length' => '%s' . lang('form_error_tip_2')
            )
        )
    )
);





/* End of file config.php */
/* Location: ./application/config/config.php */