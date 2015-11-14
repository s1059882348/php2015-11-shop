<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-11
 * Time: 下午10:02
 */

namespace Admin\Service;


use Org\Util\String;

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
    public function getPermission($admin_id){
        $sql = "select  distinct  id,url from permission  where id in
        (select  distinct rp.permission_id from  admin_role as ar  join role_permission as rp on ar.role_id = rp.role_id  where ar.admin_id = $admin_id)
        or id in(select  ap.permission_id from admin_permission as ap where ap.admin_id = $admin_id);";

        $rows =   M()->query($sql);
        return $rows;
    }

    //保存登录信息
    public function saveLogin($admin_id){
        //自动生成随机字符串，并保存到用户信息
        $auto_key = String::randString();
        $adminModel  = M('Admin');
        $rst=$adminModel->save(array('auto_key'=>$auto_key,'id'=>$admin_id));
        //将auto_key加盐加密
        $salt = $adminModel->getFieldById($admin_id,'salt');
        $auto_key = md5($auto_key.$salt);
        //保存到cookie中
        cookie('admin_id',$admin_id,60*60*24*7);
        cookie('auto_key',$auto_key,60*60*24*7);
    }



    //自动登录，用户登录时将登录信息保存到cookie中（saveLogin）登陆页面的选项
    //跳转地址时自动登录（已经退出时），退出是清空一些session
    public function autoLogin(){
        //得到cookie中信息
        $admin_id = cookie('admin_id');
        $auto_key = cookie('auto_key');
        //如果没有cookie的值就需要到登录页面登录
        if(empty($admin_id) || empty($auto_key)){
            return false;
        }
        //查找是否有该用户
        $adminModel  = M('Admin');
        $row = $adminModel->getById($admin_id);
        if($row){
            //对比加密后的auto_key
            if($auto_key==md5($row['auto_key'].$row['salt'])){
                //比对通过，自动登录
                login($row);
                //保存权限的url和id
                $permissions = $this->getPermissions($row['id']);
                savePermissionURL(array_column($permissions,'url'));
                savePermissionId(array_column($permissions,'id'));
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }




}