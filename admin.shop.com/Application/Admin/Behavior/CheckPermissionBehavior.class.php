<?php

/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-11
 * Time: 下午10:32
 */
namespace Admin\Behavior;
use Think\Behavior;

class CheckPermissionBehavior extends Behavior
{

    //实现没有登录的用户要跳转到登录页面
    public function run(&$params){
        //>>1.定义不需要登陆验证的地址
        $noCheck=array('Login/checkLogin','Verify/index');
        //>>2.获取用户正在访问的url地址
        $requestURL=CONTROLLER_NAME.'/'.ACTION_NAME;
        if(in_array($requestURL,$noCheck)){
           return;  //return false  返回执行地址，不向下走
        }
        header('Content-Type: text/html;charset=utf8');
        //>>1.判定用户是否登陆
        if(!isLogin()){
             redirect(U('Login/checkLogin'),1,'请登录');
        }
        //>>2.判定登陆用户访问的url是否在他的权限范围之内
        $urls = savePermissionURL();
//        var_dump($urls);
//        exit;
//        if(!in_array($requestURL,$urls)){
//            echo '权限不足!请求联系管理员!';
//            exit;
//        }

    }


}