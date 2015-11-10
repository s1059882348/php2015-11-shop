<?php


namespace Admin\Controller;

use Think\Controller;

class ArticleController extends BaseController
{
    protected $meta_title='文章';

    protected function _before_edit_view(){
        //>>1.准备文章分类数据
        $articleCategoryModel = D('ArticleCategory');
        $articleCategorys  = $articleCategoryModel->getShowList();
        $this->assign('articleCategorys',$articleCategorys);
    }

    //添加商品信息
    public function add()
    {
        if (IS_POST) {
            //2 使用模型中的create方法收集和验证数据，并自动完成
            if (($data=$this->model->create()) !== false) {
                $data['content'] = I('post.content','',false);
                //3 将数据添加到数据库
                if ($this->model->add($data) !== false) {
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

    //修改文章信息
    public function edit($id)
    {
        if (IS_POST) {
            // create方法收集数据，save更新数据
            if (($data=$this->model->create()) !== false) {
                $data['content'] = I('post.content','',false);
                if ($this->model->save($data) !== false) {
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

    //根据关键字搜索文章
    public function search($keyword){
        $articleModel=D('Article');
        $wheres=array();
        $wheres['name']=array('like',"%".$keyword."%");
        $rows=$articleModel->getShowList("id,name",$wheres);
//        var_dump($rows);
//        exit;
        $this->ajaxReturn($rows);
    }

}