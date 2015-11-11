<?php


namespace Admin\Controller;

use Think\Controller;

class AdminController extends BaseController
{
    protected $meta_title='管理员';
    protected $usePostAllParams = true;

    protected function _before_edit_view(){
        //准备所有的角色数据
        $roleModel=D('Role');
        $roles=$roleModel->getShowList('id,name');
        $this->assign('roles',$roles);

        //准备所有的权限数据
        $permissionModel=D('Permission');
        $permissions=$permissionModel->getList();
        $this->assign('nodes',json_encode($permissions));


        $id=I('get.id');
        if(!empty($id)){
            //编辑时，显示用户的所属角色数据
            $role_ids=$this->model->getRoleByAdminId($id);
            $this->assign('role_ids',json_encode($role_ids));

            //编辑时，显示用户的额外权限数据
            $permission_ids=$this->model->getPermissionByAdminId($id);
            $this->assign('permission_ids',json_encode($permission_ids));

        }

    }


    //重置密码
    public function initPassword($admin_id){
        $result=$this->model->initPassword($admin_id);
        if($result===false){
            $this->error('重置密码失败');
        }else{
            $this->success('重置密码成功',cookie('__forword__'));
        }
    }



}