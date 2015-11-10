<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-10
 * Time: 下午3:30
 */

namespace Admin\Model;


use Think\Model;

class GoodsMemberPriceModel  extends  Model
{
    public function getGoodsMemberPrice($id){
        $rows = $this->where(array('goods_id'=>$id))->select();
        $member_level_id=array_column($rows,'member_level_id');
        $price=array_column($rows,'price');
        return array_combine($member_level_id,$price);
    }

}