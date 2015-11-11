<?php


namespace Admin\Model;


use Think\Model;

class RoleModel extends BaseModel
{
    //自动验证定义
    protected $_validate =array(
        array('name','require','角色名称不能够为空!'),
        array('status','require','状态不能够为空!'),
        array('sort','require','排序不能够为空!'),
    );

    public function add($requestData){
        $role_id=parent::add();
        if($role_id===false){
            return false;
        }
        //将角色的所属权限保存到role_permission
        $result=$this->handlePermission($role_id,$requestData['permission_ids']);
        if($result===false){
            return false;
        }
        return $role_id;
    }

    public function save($requestData){
        $result=parent::save();
        if($result===false){
            return false;
        }
        //将角色的所属权限更新到role_permission
        $result=$this->handlePermission($requestData['id'],$requestData['permission_ids']);
        if($result===false){
            return false;
        }
        return $result;
    }

    private function handlePermission($role_id,$permission_ids){
        $rolePermissionModel=M('RolePermission');
        $rows=array();
        foreach($permission_ids as $permission_id){
            $rows[]=array('role_id'=>$role_id,'permission_id'=>$permission_id);
        }
        $rolePermissionModel->where(array('role_id'=>$role_id))->delete();
        if(!empty($rows)){
            $result=$rolePermissionModel->addAll($rows);
            if($result===false){
                $this->error='保存权限失败';
                return false;
            }
        }
    }

    public function getPermissionByRoleId($role_id){
        $sql="select permission_id from role_permission where role_id=".$role_id;
        $rows=$this->query($sql);
        $permission_ids=array_column($rows,'permission_id');
        return $permission_ids;
    }



}