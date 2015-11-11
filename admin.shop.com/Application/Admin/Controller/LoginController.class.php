<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-11
 * Time: 下午3:00
 */

namespace Admin\Controller;


use Think\Controller;

class LoginController extends Controller
{


    public function checkLogin(){
        if(IS_POST){



        }else{
            $this->display('login');
        }
    }


}