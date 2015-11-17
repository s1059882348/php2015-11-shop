<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-17
 * Time: 下午5:26
 */

namespace Home\Controller;


use Think\Controller;

class ShoppingCarController extends Controller
{
    public function index(){
        $shoppingCarModel=D('ShoppingCar');
        $shoppingCar=$shoppingCarModel->getList();
        $this->assign('shoppingCar',$shoppingCar);
        $this->display('index');
    }

    //添加商品到购物车
    public function add(){
        $params=I('post.');
        $shoppingCarModel=D('ShoppingCar');
        $result=$shoppingCarModel->add($params);
        if($result){
            $this->success('添加成功',U('index'));
        }else{
            $this->error('添加失败');
        }
    }

}