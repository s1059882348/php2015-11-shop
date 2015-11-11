<?php


namespace Admin\Controller;

use Think\Controller;

class RoleController extends BaseController
{
    protected $meta_title='角色';
    protected $usePostAllParams = true;


    protected function _before_edit_view(){
        //角色的edit页面的权限数据
        $permissionModel=D('Permission');
        $permissions=$permissionModel->getList();
        $this->assign('nodes',json_encode($permissions));

        $id=I('get.id');
        if(!empty($id)){
            $permission_ids=$this->model->getPermissionByRoleId($id);
            $this->assign('permission_ids',json_encode($permission_ids));
        }


    }



}