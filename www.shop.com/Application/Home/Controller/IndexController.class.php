<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function _initialize(){
        $goodsCategoryModel=D('GoodsCategory');
        $goodsCategorys=$goodsCategoryModel->getList();
        $this->assign('goodsCategorys',$goodsCategorys);

        $articleCategoryModel=D('ArticleCategory');
        $articleCategorys=$articleCategoryModel->getList();
        $this->assign('articleCategorys',$articleCategorys);

        $articleModel=D('Article');
        $articles=$articleModel->getList();
        $this->assign('articles',$articles);
    }

    public function index()
    {
         $goodsModel = D('Goods');
         $goods_1s = $goodsModel->getGoodsbyGoodsStatus(1);
         $goods_2s = $goodsModel->getGoodsbyGoodsStatus(2);
         $goods_4s = $goodsModel->getGoodsbyGoodsStatus(4);
         $goods_8s = $goodsModel->getGoodsbyGoodsStatus(8);
         $goods_16s = $goodsModel->getGoodsbyGoodsStatus(16);
        $this->assign(array(
            'isHiddenMenu'=>false,
            'meta_title'=>'京西商城首页',
            'goods_1s'=>$goods_1s,
            'goods_2s'=>$goods_2s,
            'goods_4s'=>$goods_4s,
            'goods_8s'=>$goods_8s,
            'goods_16s'=>$goods_16s,
        ));
        $this->assign('isHiddenMenu',false);
        $this->display('index');
    }

    public function lst(){
        $this->assign(array(
            'isHiddenMenu'=>true,
            'meta_title'=>'商品列表'
        ));
        $this->display('lst');
    }

    public function goods(){
        $this->assign(array(
            'isHiddenMenu'=>true,
            'meta_title'=>'京西商城，xxx商品'
        ));
        $this->display('goods');
    }

}