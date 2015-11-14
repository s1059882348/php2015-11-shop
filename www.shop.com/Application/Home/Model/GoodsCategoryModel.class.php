<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-14
 * Time: 上午11:14
 */

namespace Home\Model;


use Think\Model;

class GoodsCategoryModel extends Model
{
    public function getList(){
        $goodsCategorys=S('GoodsCategorys');
        if(!$goodsCategorys){
            $goodsCategorys=$this->field('id,name,parent_id,level')->where(array('status'=>1,'is_help'=>1))->order('lft')->select();
            S('GoodsCategorys',$goodsCategorys);
        }
        return $goodsCategorys;
    }

}