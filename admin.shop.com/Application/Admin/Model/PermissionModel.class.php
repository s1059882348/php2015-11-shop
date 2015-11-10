<?php


namespace Admin\Model;


use Admin\Service\NestedSetsService;
use Think\Model;

class PermissionModel extends BaseModel
{
    //自动验证定义
    protected $_validate =array(
        array('name','require','权限名称不能够为空!'),
//        array('url','require','权限URL地址不能够为空!'),
//        array('parent_id','require','父权限不能够为空!'),
//        array('lft','require','左边界不能够为空!'),
//        array('rght','require','右边界不能够为空!'),
//        array('level','require','级别不能够为空!'),
        array('status','require','状态不能够为空!'),
        array('sort','require','排序不能够为空!'),
    );


    public function getList($fields='id,name,parent_id'){
        return $this->field($fields)->where('status>=0')->order('lft')->select();
    }

    //覆盖add方法
    public function add(){
        $dbMysqlInterfaceImplModel  = new DbMysqlInterfaceImpModel();
        $nestedSetService = new NestedSetsService($dbMysqlInterfaceImplModel,'permission','lft','rght','parent_id','id','level');
        return $nestedSetService->insert($this->data['parent_id'],$this->data,'bottom');
    }

    //覆盖save方法
    public function save(){
        $dbMysqlInterfaceImplModel  = new DbMysqlInterfaceImpModel();
        $nestedSetService = new NestedSetsService($dbMysqlInterfaceImplModel,'permission','lft','rght','parent_id','id','level');
        $result=$nestedSetService->moveUnder($this->data['id'],$this->data['parent_id'],'bottom');
        if($result===false){
            $this->error='不能将父分类移到子分类下面';
            return false;
        }
        return parent::save();
    }



}