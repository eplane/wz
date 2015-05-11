<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/* Date Object Cache Layer
 *
 *
 *
 */

require_once('docl/Object.php');

class DOCL
{
    private $db;
    private $cache;

    public function __construct()
    {
        $CI =& get_instance();
        $CI->load->library('Edb');
        $CI->load->library('ECache');

        $this->db    =$CI->edb;
        $this->cache = $CI->ecache;
    }

    public function get_object($class, $params)
    {
        require_once('docl/object/' . $class . '.php');

        $o = new $class($params);

        return $o;
    }
}