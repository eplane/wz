<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('m_base.php');

class m_role extends m_base
{
    public function __construct()
    {
        parent::__construct();
    }

    /** 获得一个角色的信息
     * @param int $id
     * @return bool | array
     *  即使角色被停用了，也会正常返回数据。
     */
    public function get($id)
    {
        return $this->edb->select_row('role', '`id` = ' . $id);
    }

    /** 获得一个用户的全部角色信息
     * @param string | array $roles 要查询的角色列表，可以是字符串，用空格分割id，也可以是一个id数组
     * @return bool | array
     * 即使角色被停用了，也会正常返回数据。
     */
    public function gets($roles)
    {
        $data = [];

        if(FALSE === is_string($roles))
        {
            $roles = explode(' ', $roles);
        }

        foreach($roles as $row)
        {
            $data = [] = $this->get($row);
        }

        return $data;
    }
}