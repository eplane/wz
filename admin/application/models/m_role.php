<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('m_base.php');


class m_role extends m_base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($id)
    {
        return $this->edb->select_row('role', '`id` = ' . $id);
    }
}