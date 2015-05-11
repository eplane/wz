<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 数据对象基类
 *
 *
 */

abstract class DOC_Object
{
    protected $db;
    protected $cache;

    protected $valid = FALSE;

    public function __construct()
    {
        $CI =& get_instance();
        $CI->load->library('Edb');
        $CI->load->library('ECache');

        $this->db    =$CI->edb;
        $this->cache = $CI->ecache;
    }
}