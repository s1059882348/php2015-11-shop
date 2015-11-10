<?php


namespace Admin\Controller;

use Think\Controller;

class GoodsController extends BaseController
{
    protected $meta_title='商品';


    //在编辑页面展示之前向页面分配数据  在展示分类列表时用到的js需要分类信息的json数据
    protected function _before_edit_view(){
        //获取json字符串,显示分类树
        $goodsCategoryModel= D('GoodsCategory');
        $rows=$goodsCategoryModel->getList();      //getShowList('*',$wheres=array('status>=0'));
//        $rows = $this->model->getList();
        $this->assign('nodes',json_encode($rows));  //因为ztree中需要的是json字符串
//        var_dump($rows);
//        exit;

        //品牌数据
        $brandModel=D('Brand');
        $brands = $brandModel->getShowList();
        $this->assign('brands',$brands);

        //供货商数据
        $supplierModel=D('Supplier');
        $suppliers = $supplierModel->getShowList();
        $this->assign('suppliers',$suppliers);

        //会员价格
        $memberLevelModel=D('MemberLevel');
        $memberLevels = $memberLevelModel->getShowList('id,name');
        $this->assign('memberLevels',$memberLevels);


        $id=I('get.id');
        if(!empty($id)){
            //商品描述
            $goodsIntroModel=M('GoodsIntro');
            $intro=$goodsIntroModel->getFieldByGoods_id($id,'intro');
            $this->assign('intro',$intro);
            //商品图片
            $goodsGalleryModel=D('GoodsGallery');
//            $goodsGallerys=$goodsGalleryModel->getFieldByGoods_id($id,'path');
            $goodsGallerys = $goodsGalleryModel->getGalleryByGoods_id($id);
            $this->assign('goodsGallerys',$goodsGallerys);
            //商品相关文章数据
            $goodsArticleModel = D('GoodsArticle');
            $goodsAritcles = $goodsArticleModel->getArticleByGoodsId($id);
//            var_dump($goodsAritcles);
//            exit;
            $this->assign('goodsAritcles',$goodsAritcles);
            //商品会员价格
            $goodsMemberPriceModel = D('GoodsMemberPrice');
            $goodsMemberPrices = $goodsMemberPriceModel->getGoodsMemberPrice($id);
//            var_dump($goodsMemberPrices);
//            exit;
            $this->assign('goodsMemberPrices',$goodsMemberPrices);

        }





    }

    //添加商品信息
    public function add()
    {
        if (IS_POST) {
            //2 使用模型中的create方法收集和验证数据，并自动完成
            if ($this->model->create() !== false) {
                $requestData=I('post.');
                $requestData['intro']=I('post.intro','',false);
                //3 将数据添加到数据库
                if ($this->model->add($requestData) !== false) {
                    $this->success('添加成功', U('index'));
                    return;
                }
            }
            $msg = showErrors($this->model); //封装函数在公共函数
            $this->error('添加失败' . $msg);
        } else {
            //钩子方法占位
            $this->_before_edit_view();
            //4 显示视图
            $this->assign('meta_title', '添加' . $this->meta_title);
            $this->display('edit');
        }
    }

    //修改商品信息
    public function edit($id)
    {
        if (IS_POST) {
            // create方法收集数据，save更新数据
            if ($this->model->create() !== false) {
                $requestData=I('post.');
                $requestData['intro']=I('post.intro','',false);
                if ($this->model->save($requestData) !== false) {
                    $this->success('更新成功', U('index'));
                    return;
                }
            }
            $msg = showErrors($this->model); //封装函数在公共函数
            $this->error('更新失败' . $msg);
        } else {
            // 根据id查找要编辑的信息
            $row = $this->model->find($id);
            // 显示视图
            $this->assign($row);
            $this->assign('meta_title', '编辑' . $this->meta_title);
            //钩子方法占位
            $this->_before_edit_view();
            $this->display('edit');
        }
    }

    //根据商品相册图片的id，通过ajax请求删除数据
    public function deleteGallery($gallery_id){
        $goodsGalleryModel = D('GoodsGallery');
        $result = array('success'=>false);
        if($goodsGalleryModel->delete($gallery_id)!==false){
            $result['success'] = true;
        }
        $this->ajaxReturn($result);
    }

}