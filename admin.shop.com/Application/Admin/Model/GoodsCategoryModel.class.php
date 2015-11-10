<?php


namespace Admin\Model;


use Admin\Service\NestedSetsService;
use Think\Model;

class GoodsCategoryModel extends BaseModel
{
    //自动验证定义
    protected $_validate =array(
        array('name','require','名称不能够为空!'),
        array('lft','require','左边界不能够为空!'),
        array('rght','require','右边界不能够为空!'),
        array('level','require','级别不能够为空!'),
        array('status','require','状态不能够为空!'),
        array('sort','require','排序不能够为空!'),
    );

    //获取商品分类信息列表
    public function getList(){
        return $this->where('status>=0')->order('lft')->select();
    }

    //覆盖add方法
    public function add(){
        //使用业务类NestedSetService 查看它的第86行
        $dbMysqlInterfaceImplModel  = new DbMysqlInterfaceImpModel();
        $nestedSetService = new NestedSetsService($dbMysqlInterfaceImplModel,'goods_category','lft','rght','parent_id','id','level');
        //调用业务类的添加方法  查看它的第181行
//        var_dump($this->data);
//        exit;
        return $nestedSetService->insert($this->data['parent_id'],$this->data,'bottom');
    }

    //覆盖save方法
    public function save(){
        //使用业务类NestedSetService 查看它的第86行
        $dbMysqlInterfaceImplModel  = new DbMysqlInterfaceImpModel();
        $nestedSetService = new NestedSetsService($dbMysqlInterfaceImplModel,'goods_category','lft','rght','parent_id','id','level');
        //调用业务类的更新方法  查看它的第293行
//        var_dump($this->data);
//        exit;
        $result=$nestedSetService->moveUnder($this->data['id'],$this->data['parent_id'],'bottom');

        if($result===false){
            $this->error='不能将父分类移到子分类下面';
            return false;
        }


        return parent::save();
    }

    //覆盖changeStatus方法，将id及id的子分类的状态一起修改
    public function changeStatus($id, $status)
    {
        //父分类id
        $sql='select  child.id   from goods_category as parent,goods_category as child
where child.lft>=parent.lft and child.rght<=parent.rght and parent.id = '.$id;
        $data = array('status' => $status);
        $rows=$this->query($sql);
        $ids=array_column($rows,'id');
//        $temp=array();
//        foreach($rows as $row){
//            $temp[]=$row['id'];
//        }
//        dump($ids);
//        exit;
        return parent::changeStatus($ids,$status);
    }


}