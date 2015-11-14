<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-14
 * Time: 下午8:18
 */

namespace Home\Model;


use Think\Model;

class GoodsModel extends Model
{

    public  function getGoodsbyGoodsStatus($goods_status,$limit=5){
        $wheres = array('status'=>1,'is_on_sale'=>1);
        $rows = $this->field('id,logo,name,shop_price')->where($wheres)->
        where("goods_status&{$goods_status}>0")->limit($limit)->order('sort')->select();
        return $rows;
    }

}