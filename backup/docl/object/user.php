<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 *
 *
 */

//require_once('../Object.php');

class user extends DOC_Object
{
    public $id;
    public $uid;
    public $email;
    public $nickname;
    public $confirm;
    public $last_ip;
    public $last_time;
    public $reg_time;

    public function __construct($id)
    {
        parent::__construct();

        $data = $this->db->select_row('user', '`uid` = "'.$id.'" AND `delete` = 0');

        if( !!$data )
            $this->valid = TRUE;

        $this->id = $id;
        $this->uid = $data['uid'];
        $this->email = $data['email'];
        $this->nickname = $data['nickname'];
        $this->confirm = $data['confirm'];
        $this->last_ip = $data['last_ip'];
        $this->last_time = $data['last_time'];
        $this->reg_time = $data['reg_time'];
        $this->time = time();
    }

    public function save($data)
    {

    }
}