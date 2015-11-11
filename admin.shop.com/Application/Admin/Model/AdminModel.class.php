<?php


namespace Admin\Model;


use Think\Model;

class AdminModel extends BaseModel
{
    //自动验证定义
    protected $_validate =array(
        array('username','require','用户名不能够为空!'),
        array('password','require','密码不能够为空!'),
        array('email','email','邮箱格式不正确！'),
        array('add_time','require','加入时间不能够为空!'),
        array('last_login_time','require','最后登录时间不能够为空!'),
        array('salt','require','加严项不能够为空!'),
        array('status','require','状态不能够为空!'),
        array('sort','require','排序不能够为空!'),
    );

    //自动完成
    protected $_auto =array(
        array('add_time',NOW_TIME),
        array('salt','\Org\Util\String::randString','','function'),
    );

    public function add($requestData){
        $this->data['password']=md5($this->data['password'].$this->data['salt']);
        $admin_id=parent::add();
        if($admin_id===false){
            return false;
        }
        //将用户的所属角色保存到admin_role
        $result=$this->handleRole($admin_id,$requestData['role_ids']);
        if($result===false){
            return false;
        }
        //将用户的额外权限保存到admin_permission
        $result=$this->handlePermission($admin_id,$requestData['permission_ids']);
        if($result===false){
            return false;
        }

        return $admin_id;
    }

    public function save($requestData){
        $result=parent::save();
        if($result===false){
            return false;
        }
        //将用户的所属角色更新到admin_role
        $result=$this->handleRole($requestData['id'],$requestData['role_ids']);
        if($result===false){
            return false;
        }
        //将用户的额外权限更新到admin_permission
        $result=$this->handlePermission($requestData['id'],$requestData['permission_ids']);
        if($result===false){
            return false;
        }

        return $result;
    }


    private function handleRole($admin_id,$role_ids){
        $adminRoleModel=M('AdminRole');
        $rows=array();
        foreach($role_ids as $role_id){
            $rows[]=array('admin_id'=>$admin_id,'role_id'=>$role_id);
        }
        $adminRoleModel->where(array('admin_id'=>$admin_id))->delete();
        if(!empty($rows)){
            $result=$adminRoleModel->addAll($rows);
            if($result===false){
                $this->error='保存所属角色失败';
                return false;
            }
        }
    }


    private function handlePermission($admin_id,$permission_ids){
        $adminPermissionModel=M('AdminPermission');
        $rows=array();
        foreach($permission_ids as $permission_id){
            $rows[]=array('admin_id'=>$admin_id,'permission_id'=>$permission_id);
        }
        $adminPermissionModel->where(array('admin_id'=>$admin_id))->delete();
        if(!empty($rows)){
            $result=$adminPermissionModel->addAll($rows);
            if($result===false){
                $this->error='保存额外权限失败';
                return false;
            }
        }
    }

    public function getRoleByAdminId($admin_id){
        $sql="select role_id from admin_role where admin_id=".$admin_id;
        $rows=$this->query($sql);
        $role_ids=array_column($rows,'role_id');
        return $role_ids;
    }

    public function getPermissionByAdminId($admin_id){
        $sql="select permission_id from admin_permission where admin_id=".$admin_id;
        $rows=$this->query($sql);
        $permission_ids=array_column($rows,'permission_id');
        return $permission_ids;
    }

    public function initPassword($admin_id){
        $salt=$this->getFieldById($admin_id,'salt');
        $password=md5('111'.$salt);
        return parent::save(array('id'=>$admin_id,'password'=>$password));
    }



}