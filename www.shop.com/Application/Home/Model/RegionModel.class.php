<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-20
 * Time: 下午6:48
 */

namespace Home\Model;


use Think\Model;

class RegionModel extends Model
{
    //获取子类，默认父分类为0
    public function getChildren($parent_id=0){
        return $this->field('id,name')->where(array('parent_id'=>$parent_id))->select();
    }

}