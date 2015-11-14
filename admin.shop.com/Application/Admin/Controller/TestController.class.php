<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-14
 * Time: 上午9:44
 */

namespace Admin\Controller;


use Think\Controller;

class TestController extends Controller
{
    public function index(){
        session('name','xxx');
    }
    public function get(){
        dump(session('name'));
    }

}