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

    /**
     * 根据商品状态得到商品信息，为首页的推荐、热销等准备
     * @param $goods_status
     * @param int $limit
     * @return mixed
     */
    public  function getGoodsbyGoodsStatus($goods_status,$limit=5){
        $wheres = array('status'=>1,'is_on_sale'=>1);
        $rows = $this->field('id,logo,name,shop_price')->where($wheres)->
        where("goods_status&{$goods_status}>0")->limit($limit)->order('sort')->select();
        return $rows;
    }


    public function get($id){
        //根据商品id获取商品信息
        $goods=$this->where(array('id'=>$id))->select();
        $goods=$goods[0];
        //获取商品的品牌
        $sql="select b.name from goods as g join brand as b on g.brand_id = b.id  where g.id = $id";
        $goodsBrand=$this->query($sql);
        $brand_name=implode('',array_column($goodsBrand,'name'));
        $goods['brand_name']=$brand_name;
        //当前商品的分类以及父分类
        $sql = "select gc.id,gc.name from goods_category as gc2 ,goods_category as gc where  gc.lft<=gc2.lft and gc.rght >= gc2.rght  and gc2.id ={$goods['goods_category_id']} and gc.status=1  order by gc.lft";
        $goodsCategorys  = $this->query($sql);
        $goods['goodsCategorys'] = $goodsCategorys;
        //获取当前商品的相册数据
        $gallerys=M('GoodsGallery')->field('path')->where(array('goods_id'=>$id))->select();
        $gallerys=array_column($gallerys,'path');
        array_unshift($gallerys,$goods['logo']);

        $goods['gallerys'] = $gallerys;
//        var_dump($goods);exit;
        return $goods;
    }


}