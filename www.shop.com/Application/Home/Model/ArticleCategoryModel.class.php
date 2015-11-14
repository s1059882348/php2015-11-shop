<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-14
 * Time: 下午1:20
 */

namespace Home\Model;


use Think\Model;

class ArticleCategoryModel extends Model
{

    public function getList(){
        $articleCategorys=S('ArticleCategorys');
        if(!$articleCategorys){
            $articleCategorys=$this->field('id,name')->where(array('status'=>1,'is_help'=>1))->order('lft')->select();
            S('ArticleCategorys',$articleCategorys);
        }
        return $articleCategorys;
    }

}