<?php
/**
 * Created by PhpStorm.
 * User: ����
 * Date: 15-10-30
 * Time: ����4:43
 */

namespace Admin\Model;


use Think\Model;

class SupplierModel extends BaseModel
{
    //自动验证定义
    protected $_validate =array(
        array('name','require','供货商名称不能为空'),
        array('name','','名称不能重复','','unique'),
        array('intro','require','供货商简介不能为空'),
    );
}