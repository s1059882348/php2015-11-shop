<?php


namespace Admin\Controller;

use Think\Controller;

class GoodsCategoryController extends BaseController
{
    protected $meta_title='商品分类';

    public function index(){
        $rows=$this->model->getList();
        $this->assign('rows',$rows);
        $this->assign('meta_title',$this->meta_title);
        cookie('__forward__', $_SERVER[REQUEST_URI]);
        $this->display('index');
    }

    //在编辑页面展示之前向页面分配数据  在展示分类列表时用到的js需要分类信息的json数据
    protected function _before_edit_view(){
        $rows = $this->model->getList();
        $this->assign('nodes',json_encode($rows));  //因为ztree中需要的是json字符串
//        var_dump($rows);
//        exit;
    }

    //根据id将对应的记录的状态修改为指定的值,商品分类的子分类也要改变状态
    public function changeStatus($id, $status = -1)
    {
        //2 使用SupplierModel中的changeStatus()方法
        $rst = $this->model->changeStatus($id, $status);
        //3 判断结果
        if ($rst !== false) {
            $this->success('操作成功', cookie('__forward__'));
        } else {
            $this->error('操作失败');
        }
    }


}