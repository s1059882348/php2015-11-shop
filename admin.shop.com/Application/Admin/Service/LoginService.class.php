<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-11
 * Time: 下午10:02
 */

namespace Admin\Service;


class LoginService
{

    /**
     * 根据用户名和密码登录验证
     * @param $username
     * @param $password
     * @return mixed
     */
    public function login($username,$password){
        $adminModel=D('Admin');
        $user=$adminModel->getByUsername($username);
        if($user){
            if($user['password']==md5($password.$user['salt'])){
                return $user;
            }else{
                $this->error='密码不正确';
            }
        }else{
            $this->error='用户名不存在';
        }
    }

    /**
     * 根据用户id得到用户权限的URL地址
     * @param $admin_id
     * @return array
     */
    public function getPermissionURL($admin_id){
        $sql = "select  distinct  url from permission  where id in
        (select  distinct rp.permission_id from  admin_role as ar  join role_permission as rp on ar.role_id = rp.role_id  where ar.admin_id = 3)
        or id in(select  ap.permission_id from admin_permission as ap where ap.admin_id = $admin_id);";

        $rows =   M()->query($sql);
        return array_column($rows,'url');
    }


}