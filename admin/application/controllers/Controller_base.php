<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Controller_base extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    protected function view($page, $data)
    {
        if (!!$page)
            $data['page'] = $this->load->view($page, $data, TRUE);

        $this->load->view('template', $data);
    }
}