<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('Controller_base.php');

class Company extends Controller_base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //路径导航条数据
        $data['nav'] = ['主页'=>''];

        $this->view('main', $data);
    }

    public function edit()
    {
        $this->load->library('Form_validation');
        $this->load->helper('form');

        //路径导航条数据
        $data['nav'] = ['主页'=>'main.html', '公司信息'=>''];

        $this->view('company-info', $data);
    }
}