<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('m_base.php');

class m_user extends m_base
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $uid
     * @param $password
     * @return bool
     */
    public function login_admin($uid, $password)
    {
        /*
         * 获得用户数据，不能使用缓存数据
         * */
        $data = $this->edb->select_row('user', '`uid` = "' . $uid . '" AND `psw` = "' . md5($password) . '" AND `status`="normal"', '`id`,`uid`,`email`,`mobile`,`status`');

        $user = NULL;

        //获得用户数据
        if (FALSE != $data)
        {
            $info = $this->edb->select_row('user_info', '`uid` = "' . $uid . '"');

            //获得角色列表
            $this->load->model('m_role', 'mrole');
            $roles = $this->mrole->gets($info['role']);

            var_dump($roles);

            //判断是否拥有合法的角色
        }

        return $user != NULL;
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

    public function save($id, $data)
    {
        $login['mobile'] = $data['mobile'];
        $login['email'] = $data['email'];

        $this->edb->update('user', $login, '`id` = ' . $id);

        $info['name'] = $data['name'];
        $info['nickname'] = $data['nickname'];
        $info['sex'] = $data['sex'];
        $info['birthday'] = $data['birthday'];

        if (isset($data['avatar']))
        {
            $info['avatar'] = $data['avatar'];

            $old_avatar = $this->session->user['avatar'];

            if ($old_avatar != '')
            {
                $this->load->library('Efile');
                $this->efile->delete($old_avatar);
            }
        }

        $this->edb->update('user_info', $info, '`id` = ' . $id);

        $this->session->user = $this->get_user(TRUE, $id);
    }

    public function search($str)
    {
        $id = $this->edb->select_one('user', '`uid`="' . $str . '" OR `mobile`="' . $str . '" OR `email`="' . $str . '"', 'id');

        return $this->get_user(FALSE, $id);
    }

    public function roles($user)
    {

    }
}