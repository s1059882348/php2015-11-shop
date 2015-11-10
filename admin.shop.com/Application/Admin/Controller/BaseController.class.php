<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-2
 * Time: 上午10:58
 */

namespace Admin\Controller;


use Think\Controller;

class BaseController extends Controller
{

    protected $model;

    public function _initialize()
    {
        // 创建模型
        $this->model = D(CONTROLLER_NAME);
    }

    //展示供货商列表
    public function index()
    {
        $wheres = array();
        //搜索关键字
        $keyword = I('get.keyword');
        if (!empty($keyword)) {
            $wheres['name'] = array('like', "%$keyword%");
        }
        //2 分页
        $pageResult = $this->model->getPageResult($wheres);
        //3 将数据分配到页面上
        $this->assign($pageResult);
        $this->assign('meta_title', $this->meta_title);  //模型继承的变量
        cookie('__forward__', $_SERVER[REQUEST_URI]);
        //4 显示视图
        $this->display('index');
    }

    //添加供货商信息
    public function add()
    {
        if (IS_POST) {
            //2 使用模型中的create方法收集和验证数据，并自动完成
            if ($this->model->create() !== false) {
                //3 将数据添加到数据库
                if ($this->model->add() !== false) {
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

    protected function _before_edit_view(){

    }

    //修改供货商信息
    public function edit($id)
    {
        if (IS_POST) {
            // create方法收集数据，save更新数据
            if ($this->model->create() !== false) {
                if ($this->model->save() !== false) {
                    $this->success('更新成功', U('index'));
                    return;
                }
            }

            $msg = showErrors($this->model); //封装函数在公共函数
            var_dump($msg);
            exit;
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

    //根据id将对应的记录的状态修改为指定的值
    public function changeStatus($id, $status = -1)
    {
        //2 使用SupplierModel中的changeStatus()方法
        $rst = $this->model->changeStatus($id, $status);
//var_dump($status);
//        exit;
        //3 判断结果
        if ($rst !== false) {
            $this->success('操作成功', cookie('__forward__'));
        } else {
            $this->error('操作失败');
        }
    }
}