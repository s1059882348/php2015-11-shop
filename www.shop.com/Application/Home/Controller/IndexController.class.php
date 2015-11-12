<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
           $this->display('index');
    }

    public function lst(){
        $this->display('lst');
    }

    public function goods(){
        $this->display('goods');
    }

}