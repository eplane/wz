<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('m_base.php');

class m_user extends m_base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login_admin($uid, $password)
    {
        $user = $this->edb->select_row('user', '`uid` = "' . $uid . '" AND `password` = "' . md5($password) . '"', '`id`,`uid`,`email`,`mobile`,`status`');

        if (NULL != $user)
        {
            //查询是否是公司职员，如果不是，拒绝登录后台
            $stuff = $this->edb->get_one(TRUE, 'stuff', '`user` = ' . $user['id']);

            if (NULL != $stuff)
            {
                $user_info = $this->edb->get_one(TRUE, 'user_info', '`id` = ' . $user['id']);

                $user = array_merge($user, $user_info);

                //保存登录用户信息
                $this->session->user = $user;

                //保存用户职务信息
                $this->session->stuff = $stuff;

                $this->load->model('m_entity', 'mentity');

                $this->session->entity = $this->mentity->get_this(TRUE);
            }
            else
            {
                //如果不是任何公司的职员
                $user = NULL;
            }
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
}