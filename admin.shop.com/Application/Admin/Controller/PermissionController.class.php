<?php


namespace Admin\Controller;

use Think\Controller;

class PermissionController extends BaseController
{
    protected $meta_title='权限';  //

    public function index(){
        $rows=$this->model->getList('id,name,parent_id,level,url,status');
//        var_dump($rows);
//        exit;
        $this->assign('rows',$rows);
        $this->assign('meta_title',$this->meta_title);
        cookie('__forward__', $_SERVER[REQUEST_URI]);
        $this->display('index');
    }

    protected function _before_edit_view(){
        $rows = $this->model->getList();
        $this->assign('nodes',json_encode($rows));
    }

}