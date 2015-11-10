<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-2
 * Time: 下午12:54
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;

class BaseModel extends Model{
    //开启批量验证
    protected $patchValidate = true;

    //分页
    public function getPageResult($wheres=array())
    {
        //条件数组  状态不是-1的记录数组
        $wheres['status']= array('neq', -1);
        //1 提供分页工具条
        $total = $this->where($wheres)->count();
        $listRows = C('PAGE_SIZE') ? C('PAGE_SIZE') : 5;
        $page = new Page($total, $listRows);
        $pageHtml = $page->show();
        //2 提供当前列表数据
        $rows = $this->where($wheres)->limit($page->firstRow, $page->listRows)->select();
        //3 返回包含分页工具条和分页列表数据的数组
        return array('pageHtml' => $pageHtml, 'rows' => $rows);
    }

    //根据id修改status的值
    public function changeStatus($id, $status)
    {
        $data = array('status' => $status);
//        dump($data);
//        exit;
        if ($status == -1) {
            $data['name'] = array('exp', "concat(name,'_del')");
        }
//        $result=$this->where(array('id' => array('in', $id)))->save($data);
//        var_dump($this->getError());
//        exit;
        $this->where(array('id' => array('in', $id)));
        return parent::save($data);
    }

    //获取数据
    public function getShowList($field="*",$wheres=array()){
        $wheres['status'] = 1;
        return $this->where($wheres)->field($field)->order('sort')->select();
    }
}