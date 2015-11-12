<?php


namespace Admin\Model;


use Admin\Service\NestedSetsService;
use Think\Model;

class MenuModel extends BaseModel
{
    //自动验证定义
    protected $_validate =array(
        array('name','require','菜单名称不能够为空!'),
//        array('url','require','菜单URL地址不能够为空!'),
//        array('parent_id','require','父菜单不能够为空!'),
//        array('lft','require','左边界不能够为空!'),
//        array('rght','require','右边界不能够为空!'),
//        array('level','require','级别不能够为空!'),
//        array('status','require','状态不能够为空!'),
//        array('sort','require','排序不能够为空!'),
    );

    public function getList($fields='id,name,parent_id'){
        return $this->field($fields)->where('status>=0')->order('lft')->select();
    }

    //覆盖add方法
    public function add($requestData){
        //保存父分类
        $dbMysqlInterfaceImplModel  = new DbMysqlInterfaceImpModel();
        $nestedSetService = new NestedSetsService($dbMysqlInterfaceImplModel,'menu','lft','rght','parent_id','id','level');
        $menu_id=$nestedSetService->insert($this->data['parent_id'],$this->data,'bottom');
        if($menu_id===false){
            return false;
        }

        //保存权限
        $result=$this->handlePermission($menu_id,$requestData['permission_ids']);
        if($result===false){
            return false;
        }
        return $menu_id;
    }

    //覆盖save方法
    public function save($requestData){
        $dbMysqlInterfaceImplModel  = new DbMysqlInterfaceImpModel();
        $nestedSetService = new NestedSetsService($dbMysqlInterfaceImplModel,'menu','lft','rght','parent_id','id','level');
        $result=$nestedSetService->moveUnder($this->data['id'],$this->data['parent_id'],'bottom');
        if($result===false){
            $this->error='不能将父分类移到子分类下面';
            return false;
        }

        //更新权限
        $result=$this->handlePermission($requestData['id'],$requestData['permission_ids']);
        if($result===false){
            return false;
        }
        return parent::save();
    }

    public function getPermissionByMenuId($menu_id){
        $sql="select permission_id from menu_permission where menu_id=".$menu_id;
        $rows=$this->query($sql);
        $permission_ids=array_column($rows,'permission_id');
        return $permission_ids;
    }

    private function handlePermission($menu_id,$permission_ids){
        $menuPermissionModel=D('MenuPermission');
        $rows=array();
        foreach($permission_ids as $permission_id){
            $rows[]=array('menu_id'=>$menu_id,'permission_id'=>$permission_id);
        }
        $menuPermissionModel->where(array('menu_id'=>$menu_id))->delete();
        if(!empty($rows)){
            $result=$menuPermissionModel->addAll($rows);
            if($result===false){
                $this->error='保存权限失败';
                return false;
            }
        }
    }



}