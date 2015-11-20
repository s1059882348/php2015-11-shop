<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-15
 * Time: 下午2:04
 */

namespace Home\Controller;


use Think\Controller;

class MemberController extends Controller
{
    public function regist(){
        if(IS_POST){

            //>>1.注册之前先对短信验证码进行验证.
//            $checkCode = I('post.checkcode');  //请求中用户输入的验证码
//            $sms_code = session('SMS_CODE');
//            if($checkCode!==$sms_code){
//                $this->error('短信验证码错误!');
//            }else{
//                session('SMS_CODE',null);
//            }

            $memberModel = D('Member');
            if ($memberModel->create() !== false) {
                if ($memberModel->add() !== false) {
                    $this->success('注册成功', U('login'));
                    return;
                }
            }
            $this->error('注册失败' );

        }else{
            $this->display('regist');
        }
    }

    //登录
    public function login(){
        if(IS_POST){
            $memberModel=D('Member');
            if($memberModel->create()!==false){
                $result=$memberModel->login();
                if(is_array($result)){
                    login($result);
                    //当在购物流程中跳转到登录界面，则登录成功后跳转到流程
                    $login_return_url=cookie('__LOGIN_RETURN_URL__');
                    if(empty($login_return_url)){
                        $login_return_url=U('Index/index');
                    }else{
                        cookie('__LOGIN_RETURN_URL__',null);
                    }
                    $this->success('登录成功',$login_return_url);
                }else{
                    $this->error('登录失败'.ShowErrors($memberModel));
                }
            }

        }else{
            $this->display('login');
        }
    }

    public function logout(){
        logout();
        $this->success('注销成功!',U('Index/index'));
    }

    public function check(){
        $params=I('get.');
        $memberModel=D('Member');
        $result=$memberModel->checkRepeat($params);
        $this->ajaxReturn($result);
    }

    /**
     * 发送验证码给这个电话号码
     * @param $tel
     */
    public function sendSMS($tel){
        $memberModel = D('Member');
        //发送短信的结果: true或者false
        $result = $memberModel->sendSMS($tel);
        $this->ajaxReturn($result);
    }

    public function fire($id,$key){
        $memberModel = D('Member');
        $result = $memberModel->fire($id,$key);
        if($result===false){
            $this->error('激活失败!,重新激活');
        }else{
            $this->success('激活成功!',U('login'));
        }
    }



}