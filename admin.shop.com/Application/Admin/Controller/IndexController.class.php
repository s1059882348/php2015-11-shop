<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{

    public function menu(){
        //准备菜单数据
        if(isSuperUser()){
            $menuModel=D('Menu');
            $menus=$menuModel->getList('id,name,url,parent_id,level');
        }else{
            $permission_ids=savePermissionId();
            if($permission_ids){
                $permission_ids=implode(',',$permission_ids);
                $sql="select distinct m.id,m.name,m.url,m.parent_id,m.level
            from menu as m join menu_permission as mp on m.id=mp.menu_id where mp.permission_id in ($permission_ids)";
                $menus=M()->query($sql);
            }
        }
//        var_dump($menus);exit;
        $this->assign('menus',$menus);
        $this->display('menu');
    }
}