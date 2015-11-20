<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-20
 * Time: 上午10:07
 */

namespace Home\Behavior;


use Think\Behavior;

class CheckUserBehavior extends Behavior
{
    public function run(&$params){
        if(islogin()){
            $userinfo=login();
            defined('UID') or define('UID',$userinfo['id']);
        }
    }

}