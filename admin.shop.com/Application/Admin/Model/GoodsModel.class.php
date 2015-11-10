<?php


namespace Admin\Model;


use Think\Model;

class GoodsModel extends BaseModel
{
    //自动验证定义
    protected $_validate =array(
//        array('name','require','名称不能够为空!'),
//        array('sn','require','货号不能够为空!'),
        array('goods_category_id','require','父分类不能够为空!'),
//        array('brand_id','require','品牌不能够为空!'),
//        array('supplier_id','require','供货商不能够为空!'),
//        array('shop_price','require','本店价格不能够为空!'),
//        array('market_price','require','市场价格不能够为空!'),
//        array('stock','require','库存不能够为空!'),
//        array('is_on_sale','require','是否上架不能够为空!'),
//        array('goods_status','require','商品状态不能够为空!'),
//        array('keyword','require','关键字不能够为空!'),
//        array('logo','require','LOGO不能够为空!'),
//        array('status','require','状态不能够为空!'),
//        array('sort','require','排序不能够为空!'),
    );

    //覆盖模型的add方法
    public function add($requestData){
        //开启事务
        $this->startTrans();

        //处理名称
        $name='';
        $this->data['name']=$this->data['name'][0];

        //处理商品状态
        $this->handleGoodsStatus();

        $id = parent::add();  //add方法返回id值
        if($id===false){
            $this->rollback(); //事务回滚
            return false;
        }

        //准备货号   str_pad
        $sn = date('Ymd').str_pad($id, 8, "0", STR_PAD_LEFT);
        $result = parent::save(array('sn'=>$sn,'id'=>$id));
        if($result===false){
            $this->rollback();
            return false;
        }

        //处理商品描述
        $result=$this->handleGoodsIntro($id,$requestData['intro']);
        if($result===false){
            return false;
        }

        //处理商品相册
        $result=$this->handleGoodsGallery($id,$requestData['gallery_path']);
        if($result===false){
            return false;
        }

        //处理商品关联文章
        $result=$this->handleGoodsArticle($id,$requestData['article_id']);
        if($result===false){
            return false;
        }

        //处理商品会员价格
        $result=$this->handleGoodsMemberPrice($id,$requestData['memberPrice']);
        if($result===false){
            return false;
        }

        $this->commit();  //事务提交
        return $id;  //返回id
    }

//    覆盖save方法
    public function save($requestData){
//        dump($this->data);
//        exit;
        //开启事务
        $this->startTrans();

        //处理名称
        $name='';
        $this->data['name']=$this->data['name'][0];

        //处理商品状态
        $this->handleGoodsStatus();

        ////处理商品描述
        $result=$this->handleGoodsIntro($this->data['id'],$requestData['intro']);
        if($result===false){
            return false;
        }

        //处理商品相册
        $result=$this->handleGoodsGallery($this->data['id'],$requestData['gallery_path']);
        if($result===false){
            $this->rollback();
            return false;
        }

        //处理商品关联文章
        $result=$this->handleGoodsArticle($this->data['id'],$requestData['article_id']);
        if($result===false){
            return false;
        }

        //调用基本模型save方法
        $result=parent::save();
        if($result===false){
            $this->rollback();
            return false;
        }

        $this->commit();  //事务提交
        return $result;
    }

    //处理商品状态
    private function handleGoodsStatus()
    {
        $goods_status = 0;  //综合的商品状态
        foreach ($this->data['goods_status'] as $v) {
            $goods_status = $goods_status | $v;
        }
        $this->data['goods_status'] = $goods_status;
    }

    //处理商品描述
    private function handleGoodsIntro($goods_id,$intro){
        $goodsIntroModel=M('GoodsIntro');
        $goodsIntroModel->where(array('goods_id'=>$goods_id))->delete();
        $result=$goodsIntroModel->add(array('goods_id'=>$goods_id,'intro'=>$intro));
        if($result==false){
            $this->rollback();
            $this->error='保存商品简介失败';
            return false;
        }
    }

    //处理商品相册
    private function handleGoodsGallery($goods_id,$gallery_paths){
        $goodsGalleryModel=M('GoodsGallery');
        $rows=array();
        foreach($gallery_paths as $gallery_path){
            $rows[]=array('goods_id'=>$goods_id,'path'=>$gallery_path);
        }
        $result=$goodsGalleryModel->addAll($rows);
        if(!empty($rows)){
            if($result==false){
                $this->rollback();
                $this->error='保存商品图片失败';
                return false;
            }
        }
    }

    //处理商关联文章
    private function handleGoodsArticle($goods_id,$article_ids){
        $goodsArticleModel=M('GoodsArticle');
        $rows=array();

        foreach($article_ids as $article_id){
            $rows[]=array('goods_id'=>$goods_id,'article_id'=>$article_id);
        }
        $goodsArticleModel->where(array('goods_id'=>$goods_id))->delete();
        $result=$goodsArticleModel->addAll($rows);
//        var_dump($rows);
//        exit;
        if(!empty($rows)){
            if($result==false){
                $this->rollback();
                $this->error='保存商品关联文章失败';
                return false;
            }
        }
    }

    //处理商品会员价格
    private function handleGoodsMemberPrice($goods_id,$prices){
        $goodMemberPriceModel=M('GoodsMemberPrice');
        $rows=array();
        foreach($prices as $key=>$price){
            $rows[]=array('goods_id'=>$goods_id,'member_level_id'=>$key,'price'=>$price);
        }
        $goodMemberPriceModel->where(array('goods_id'=>$goods_id))->delete();
        $result=$goodMemberPriceModel->addAll($rows);
//        var_dump($rows);
//        exit;
        if(!empty($rows)){
            if($result==false){
                $this->rollback();
                $this->error='保存商品会员价格失败';
                return false;
            }
        }
    }


}