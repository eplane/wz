<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('m_base.php');

class m_user extends m_base
{
    public function __construct()
    {
        parent::__construct();
    }

    /** 用户登录
     * @param $uid
     * @param $password
     * @return bool
     */
    public function login_admin($uid, $password)
    {
        //获得用户数据，不能使用缓存数据
        $data = $this->edb->select_row('user', '`uid` = "' . $uid . '" AND `psw` = "' . md5($password) . '" AND `status`="normal"', '`id`,`uid`,`email`,`mobile`,`status`');

        //获得用户数据
        if (FALSE != $data)
        {
            $info = $this->edb->select_row('user_info', '`id` = "' . $data['id'] . '"');

            //获得角色列表
            $this->load->model('m_role', 'mrole');
            $roles['role'] = $this->mrole->gets($info['role']);

            $data = array_merge($data, $info, $roles);

            //建立session
            $_SESSION['me'] = $data;

            //判断是否拥有合法的角色
            if (count($roles['role']) > 0)
            {
                return TRUE;
            }
        }

        return FALSE;
    }

    public function get_user($refresh, $id)
    {
        if (!!$id)
        {
            $login = $this->edb->get_one($refresh, 'user', '`id` = ' . $id, '`id`,`uid`,`email`,`mobile`,`status`');

            $info = $this->edb->get_one($refresh, 'user_info', '`id` = ' . $id);

            return array_merge($login, $info);
        }
        else
            return NULL;
    }
}