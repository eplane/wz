﻿<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('m_user', 'muser');
    }

    public function t()
    {
        $this->load->model('m_role', 'mrole');

        $r  =$this->mrole->gets('1,2');

        var_dump($r);
    }

    public function index()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('uid', '登录', 'callback_do_login[' . $this->input->post('password') . ']');

        if ($this->form_validation->run() == FALSE)
        {
            $data['tab_title'] = $this->config->item('title');
            $this->load->view('login', $data);
        }
        else
        {
            redirect(base_url() . 'main.html');
        }
    }

    public function do_login($user, $password)
    {
        if ($this->muser->login_admin($user, $password))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('do_login', '用户名或密码错误!');
            return FALSE;
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();

        redirect(base_url() . 'login');
    }
}