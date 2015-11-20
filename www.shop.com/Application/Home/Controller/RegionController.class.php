<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-20
 * Time: 下午7:18
 */

namespace Home\Controller;


use Think\Controller;

class RegionController extends Controller
{
    public function getChildren($parent_id=0){
        $regionModel=D('Region');
        $rows=$regionModel->getChildren($parent_id);
        $this->ajaxReturn($rows);
    }

}