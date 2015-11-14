<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-14
 * Time: 下午3:07
 */

namespace Home\Model;


use Think\Model;

class ArticleModel extends Model
{
    public function getList(){
        $articles=S('Articles');
        if(!$articles){
            $articles=$this->field('a.id,a.name,a.article_category_id')->alias('a')->join('__ARTICLE_CATEGORY__ as ac
            on a.article_category_id=ac.id')->where(array('ac.is_help'=>1,'a.status'=>1))->select();
            S('Articles',$articles);
        }
        return $articles;
    }

}