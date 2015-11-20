<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-20
 * Time: 下午4:16
 */

namespace Home\Controller;


use Think\Controller;

class AddressController extends Controller
{

    public function _initialize(){
        if(!isLogin()){
            cookie('__LOGIN_RETURN_URL__',$_SERVER['REQUEST_URI']);
            $this->error('请登录',U('Member/login'));
        }
    }
    public function index(){
        //准备省份数据
        $regionModel=D('Region');
        $regions=$regionModel->getChildren();
        $this->assign('regions',$regions);
        //准备收货地址的信息
        $addressModel=D('Address');
        $addresses=$addressModel->getList();   //
//        var_dump($addresses);exit;
        $this->assign('addresses',$addresses);
        $this->display('index');
    }

    public function add(){
        $addressModel = D('Address');
        if($data = $addressModel->create()){
            if(empty($data['id'])){
                if(($addressModel->add())!==false){
                    $this->success('添加成功!',U('index'));
                }
            }else{
                if(($addressModel->save())!==false){
                    $this->success('编辑成功!',U('index'));
                }
            }
        }
    }

    public function remove($id){
        $addressModel = D('Address');
        $result = $addressModel->delete($id);
        if($result!==false){
            $this->success('删除成功!');
        }else{
            $this->error('删除失败!');
        }
    }

    public function edit($id){
        $addressModel = D('Address');
        $address = $addressModel->find($id);
        $this->ajaxReturn($address);
    }


}