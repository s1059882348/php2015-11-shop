<?php


namespace Admin\Controller;

use Think\Controller;

class MenuController extends BaseController
{
    protected $meta_title='菜单';
    protected $usePostAllParams = true;

    public function index(){
        $rows=$this->model->getList('id,name,parent_id,status,level,sort,url,intro');
//        var_dump($rows);
//        exit;
        $this->assign('rows',$rows);
        $this->assign('meta_title',$this->meta_title);
        cookie('__forward__', $_SERVER[REQUEST_URI]);
        $this->display('index');
    }

    protected function _before_edit_view(){
        //菜单数据
        $rows = $this->model->getList();
        $this->assign('nodes',json_encode($rows));

        //权限数据
        $permissionModel=D('Permission');
        $permissions=$permissionModel->getList();
        $this->assign('nodes_permission',json_encode($permissions));


        $id=I('get.id');
        if(!empty($id)){
            $permission_ids=$this->model->getPermissionByMenuId($id);
            $this->assign('permission_ids',json_encode($permission_ids));
        }

    }

}