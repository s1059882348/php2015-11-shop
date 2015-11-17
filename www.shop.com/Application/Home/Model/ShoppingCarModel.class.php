<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-17
 * Time: 下午5:35
 */

namespace Home\Model;


class ShoppingCarModel
{

    //没有登录从cookie中获取，登录从DB中获取
    public function getList(){
        if(isLogin()){
            $shoppingCar=cookie('shopping_car');
            $shoppingCar=unserialize($shoppingCar);
            $this->bulidShoppingCar($shoppingCar);
            return $shoppingCar;
        }else{
            //从数据库中获取
        }
    }

    private function bulidShoppingCar(&$shoppingCar){
        foreach($shoppingCar as &$item){
            $row=M('Goods')->field('name,logo,shop_price')->find($item['goods_id']);
            return $item=array_merge($item,$row);
        }
    }

    /**
     * 没有登录添加到cookie，登录添加到DB
     * @param $requestData
     */
    public function add($requestData){
        if(isLogin()){
            $this->addCookie($requestData);
        }else{
            $this->addDB($requestData);
        }
    }

    public function addCookie($item){
        //从cookie中查找
        $shoppingCar=cookie('shopping_car');
        if(empty($shoppingCar)){
            $shoppingCar=array();
        }else{
            $shoppingCar=unserialize($shoppingCar);
        }
        //改变购物车的cookie
//        $goods_ids=array_column($shoppingCar,'goods_id');
//        if(in_array($item['goods_id'],$goods_ids)){
//            foreach($shoppingCar as &$shoppingCarItem){
//                if($shoppingCarItem['goods_id']==$item['goods_id']){
//                    $shoppingCarItem['num']+=$item['num'];
//                    break;
//                }
//            }
//        }else{
//            $shoppingCar[]=$item;
//        }

        $flag=false;
        foreach($shoppingCar as &$shoppingCarItem) {
            if ($shoppingCarItem['goods_id'] == $item['goods_id']) {
                $shoppingCarItem['num'] += $item['num'];
                $flag=true;
                break;
            }
        }
        if(!$flag){
            $shoppingCar[]=$item;
        }

        var_dump($shoppingCar);exit;
        cookie('shopping_car',serialize($shoppingCar));
    }

    public function addDB($item){

    }




}