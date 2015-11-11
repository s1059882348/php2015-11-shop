<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-11
 * Time: 下午3:00
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Verify;

class LoginController extends Controller
{
    public function checkLogin(){
        if(IS_POST){
//            $captcha=I('post.captcha');
//            $verify=new Verify();
//            if($verify->check($captcha)===false){
//                $this->error('验证码错误');
//            }

            //验证登录  模型方法
//            $model = D('Admin');
//            if($model->create()!==false) {
//                //登录信息验证
//                $rst = $model->login();
//                if(is_array($rst)) {
//                    session('USER_INFO',$rst);
//                    $this->success('登录成功', U('Index/index'));
//                }
//            }else{
//                $msg=showErrors($this->model);
//                $this->error('登录失败   '.$msg);
//            }

            //验证登录  Service方法
            //接收请求参数
            $username=I('post.username');
            $password=I('post.password');
            //实例化service对象
            $loginService=D('Login','Service');
            $result=$loginService->login($username,$password);
            if(is_array($result)) {
                login($result);
                //获取用户的权限地址，并保存
                $urls = $loginService->getPermissionURL($result['id']);
                savePermissionURL($urls);
                $this->success('登录成功', U('Index/index'));
            }else{
                $this->error('登录失败'.$result);
            }
        }else{
            $this->display('login');
        }
    }

    //退出
    public function logout(){
        logout();
        $this->success('退出成功！',U('checkLogin'));
    }


}