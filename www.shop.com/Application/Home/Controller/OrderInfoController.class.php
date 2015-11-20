<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-20
 * Time: 下午5:48
 */

namespace Home\Controller;


use Think\Controller;

class OrderInfoController extends Controller
{
    public function index(){
        if(!isLogin()){
            $this->error('请登录',U('Member/login'));
        }
    }

}