<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>ECSHOP 管理中心 - <?php echo ($meta_title); ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.com/Public/Admin/css/page.css" rel="stylesheet" type="text/css" />

    <link type="text/css" href="http://admin.shop.com/Public/Admin/zTree/css/zTreeStyle/zTreeStyle.css"  rel="stylesheet"/>

</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('index');?>"><?php echo substr($meta_title,6).'列表';?></a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo ($meta_title); ?> </span>
    <div style="clear:both"></div>
</h1>

<div class="main-div">
    
    <form method="post" action="<?php echo U();?>" name="listForm">
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">菜单名称</td>
                <td>
                    <input type="text" name="name" maxlength="60" value="<?php echo ($name); ?>"/>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">菜单URL地址</td>
                <td>
                    <input type="text" name="url" maxlength="60" value="<?php echo ($url); ?>"/>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">父菜单</td>
                <td>
                    <input type="hidden" name="parent_id" class="parent_id" maxlength="60" value="<?php echo ($parent_id); ?>"/>
                    <input type="text" name="parent_text" class="parent_text" maxlength="60"  disabled="disabled"  value="默认为顶级菜单"/>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label"></td>
                <td>
                    <ul id="treeDemo" class="ztree"></ul>
                </td>
            </tr>
            <tr>
                <td class="label">所属权限</td>
                <td>
                    <div id="permission_tree_permission"></div>
                    <ul id="treeDemo_permission" class="ztree"></ul>
                </td>
            </tr>
            <tr>
                <td class="label">简介</td>
                <td>
                    <textarea name="intro" cols="60" rows="4"><?php echo ($intro); ?></textarea>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">状态</td>
                <td>
                    <input type="radio" class="status" name="status" value="1"/>是<input type="radio" class="status"
                                                                                        name="status" value="0"/>否 <span
                        class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">排序</td>
                <td>
                    <input type="text" name="sort" maxlength="60" value="<?php echo ((isset($sort) && ($sort !== ""))?($sort):20); ?>"/>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><br/>
                    <input type="hidden" name="id" value="<?php echo ($id); ?>" class="button"/>
                    <input type="submit" class="button" value=" 确定 "/>
                    <input type="reset" class="button" value=" 重置 "/>
                </td>
            </tr>
        </table>
    </form>

</div>

<div id="footer">
共执行 9 个查询，用时 0.025161 秒，Gzip 已禁用，内存占用 3.258 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
<script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="http://admin.shop.com/Public/Admin/layer/layer.js"></script>
<script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/common.js"></script>
<script type="text/javascript">
    $(function(){
        //选中是否显示的状态
        $('.status').val([<?php echo ((isset($status) && ($status !== ""))?($status):1); ?>]);
    });
</script>

    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/zTree/js/jquery.ztree.core-3.5.js"></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/zTree/js/jquery.ztree.excheck-3.5.js"></script>
    <script type="text/javascript">
        $(function(){
            //1 树的设置
            var setting = {
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: "parent_id", //设置parent_id
                    }
                },
                callback: {
                    onClick: function(event, treeId, treeNode){
//                        console.debug(treeNode);
                        $('.parent_id').val(treeNode.id);
                        $('.parent_text').val(treeNode.name);
                    }
                }
            };
            //2 准备数据{ id:1, pId:0, name:"父节点1 - 展开", open:true},
            var zNodes =<?php echo ($nodes); ?>;  //注意比对例子中的数据和自己传的数据  parent_id不同
            //3  定义树的对象
            var treeObject =$.fn.zTree.init($("#treeDemo"), setting, zNodes);
            //4  使用对象中的方法让其展开  分类树全部展开
            treeObject.expandAll(true);

            //当是编辑页面时 要让分类树中的对应父分类处于选中状态
//            console.debug(<?php echo ($id); ?>);
            <?php if(!empty($id)): ?>//id是分类数据的id
            var parent_id = <?php echo ($parent_id); ?>;
            //根据parent_id找到对应的节点
            var parentNode =  treeObject.getNodeByParam('id',parent_id);
            if(parentNode){
                //选中该节点
                treeObject.selectNode(parentNode);
                //将父节点的name和id赋值给
                $('.parent_id').val(parentNode.id);
                $('.parent_text').val(parentNode.name);
            }<?php endif; ?>








            //1 树的设置
            var setting_permission = {
                check: {
                    enable: true
                },
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: "parent_id", //设置parent_id
                    }
                },
                callback: {
                    onCheck: function(event, treeId, treeNode){
                        console.debug(treeNode);
                        //获取到所有选中的节点
                        var nodes_permission =treeObject_permission.getCheckedNodes(true);
                        $('#permission_tree_permission').empty();
                        var html='';
                        $(nodes_permission).each(function(){
                            html="<input type='hidden' name='permission_ids[]' value='"+this.id+"'>";
                            $('#permission_tree_permission').append(html);
                        });
                    }
                }
            };
            //2 准备数据{ id:1, pId:0, name:"父节点1 - 展开", open:true},
            var zNodes_permission =<?php echo ($nodes_permission); ?>;  //注意比对例子中的数据和自己传的数据  parent_id不同
            //3  定义树的对象
            var treeObject_permission =$.fn.zTree.init($("#treeDemo_permission"), setting_permission, zNodes_permission);
            //4  使用对象中的方法让其展开  分类树全部展开
            treeObject_permission.expandAll(true);


            //编辑时选中角色的所属权限
            <?php if(!empty($id)): ?>var permission_ids=<?php echo ($permission_ids); ?>;
            $(permission_ids).each(function(){
                var node=treeObject_permission.getNodeByParam('id',this);
                //node:需要选中的节点, 第一个true: 表示选中,  第二个false:表示不关联, 第三true: 表示选中时激活事件
                treeObject_permission.checkNode(node,true,false,true);
            });<?php endif; ?>
        });
    </script>

</body>
</html>