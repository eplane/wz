<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('Controller_base.php');

class Main extends Controller_base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = '主页';
        $data['sub_title'] = '主页';
        $this->view('main', $data);
    }
}