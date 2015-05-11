<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class client_base extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    protected function view($dir, $view, $data=NULL)
    {
        $data['tab_title'] = $this->config->item('title');

        $data['page'] = $this->load->view($dir . $view,  $data, TRUE);

        $this->load->view($dir . 'template',  $data);
    }

    /** 根据不同分辨率自动选择视图模板
     * @return string
     */
    protected function get_template_path()
    {
        $dir = '';

        $this->load->library('user_agent');

        if ($this->agent->is_mobile())
        {
            $dir = 'portal/default/';
        }
        else
        {
            $dir = 'portal/pc/';
        }

        return $dir;
    }
}