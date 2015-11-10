<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>ECSHOP 管理中心 - <?php echo ($meta_title); ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.com/Public/Admin/css/page.css" rel="stylesheet" type="text/css" />

    <link type="text/css" href="http://admin.shop.com/Public/Admin/zTree/css/zTreeStyle/zTreeStyle.css"  rel="stylesheet"/>
    <link href="http://admin.shop.com/Public/Admin/uploadify/uploadify.css" rel="stylesheet" type="text/css" />

</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('index');?>"><?php echo substr($meta_title,6).'列表';?></a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo ($meta_title); ?> </span>
    <div style="clear:both"></div>
</h1>

<div class="main-div">
    
    <div id="tabbar-div">
        <p>
            <span class="tab-front">通用信息</span>
            <span class="tab-back">商品描述</span>
            <span class="tab-back">会员价格</span>
            <span class="tab-back">商品属性</span>
            <span class="tab-back">商品相册</span>
            <span class="tab-back">关联文章</span>
        </p>
    </div>
    <form method="post" action="<?php echo U();?>" name="listForm">
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">名称</td>
                <td>
                    <input type="text" name="name[]" maxlength="60" value="<?php echo ($name); ?>"/>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">货号</td>
                <td>
                    <input type="text" class="sn" name="sn" maxlength="60" value="默认自动生成" disabled="disabled" />
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">商品分类</td>
                <td>
                    <input type="hidden" name="goods_category_id" class="goods_category_id" maxlength="60" value="<?php echo ($goods_category_id); ?>"/>
                    <input type="text" name="goods_category_text" class="goods_category_text" maxlength="60"  disabled="disabled"  value="请选择下面的分类"/>
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
                <td class="label">品牌</td>
                <td>
                    <?php echo arr2select('brand_id',$brands,$brand_id);?>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">供货商</td>
                <td>
                    <?php echo arr2select('supplier_id',$suppliers,$supplier_id);?>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">本店价格</td>
                <td>
                    <input type="text" name="shop_price" maxlength="60" value="<?php echo ($shop_price); ?>"/>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">市场价格</td>
                <td>
                    <input type="text" name="market_price" maxlength="60" value="<?php echo ($market_price); ?>"/>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">库存</td>
                <td>
                    <input type="text" name="stock" maxlength="60" value="<?php echo ($stock); ?>"/>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">是否上架</td>
                <td>
                    <input type="radio" class="is_on_sale" name="is_on_sale" value="1"/>是
                    <input type="radio" class="is_on_sale" name="is_on_sale" value="0"/>否
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">商品状态</td>
                <td>
                    <input type="checkbox" class="goods_status" name="goods_status[]" value="1">精品
                    <input type="checkbox" class="goods_status" name="goods_status[]" value="2">新品
                    <input type="checkbox" class="goods_status" name="goods_status[]" value="4">热销
                    <span   class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">关键字</td>
                <td>
                    <input type="text" name="keyword" maxlength="60" value="<?php echo ($keyword); ?>"/>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">LOGO</td>
                <td>
                    <input type="file" name="upload-logo" id="upload-logo"/>
                    <input type="hidden" class="logo" name="logo" value="<?php echo ($logo); ?>">
                    <div class="upload-img-box" style="display: <?php echo ($logo?'block':'none'); ?>">
                        <div class="upload-pre-item">
                            <img src="/Uploads/<?php echo ($logo); ?>">
                        </div>
                    </div>
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
        </table>

        <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
            <tr>
                <td>
                    <textarea name="intro" id="intro"><?php echo ($intro); ?></textarea>
                </td>
            </tr>
        </table>
        <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
            <?php if(is_array($memberLevels)): $i = 0; $__LIST__ = $memberLevels;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$memberLevel): $mod = ($i % 2 );++$i;?><tr>
                <td class="label"><?php echo ($memberLevel["name"]); ?></td>
                <td>
                    <input type="text" name="memberPrice[<?php echo ($memberLevel["id"]); ?>]" maxlength="60" value="<?php echo ($goodsMemberPrices[$memberLevel['id']]); ?>"/>
                    <span class="require-field">*</span>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
            <tr>
                <td class="label">商品属性</td>
                <td>
                    <input type="text" name="name[]" maxlength="60" value="<?php echo ($name); ?>"/>
                    <span class="require-field">*</span>
                </td>
            </tr>
        </table>
        <style type="text/css">
            .upload-pre-item{
                position: relative;
            }
            .upload-pre-item a{

                position: absolute;
                top: 0px;
                right: 0px;
                display: block;
                background-color: red;
            }
        </style>
        <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
            <tr>
                <td>
                    <div class="upload-img-box upload-gallery-box" >
                        <?php if(is_array($goodsGallerys)): $i = 0; $__LIST__ = $goodsGallerys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goodsGallery): $mod = ($i % 2 );++$i;?><div class="upload-pre-item" style="display: inline-block">
                                <img src="/Uploads/<?php echo ($goodsGallery["path"]); ?>">
                                <a dbid="<?php echo ($goodsGallery["id"]); ?>" href="javascript:;">X</a>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="file" id="upload-gallery"/>(支持批量上传)
                </td>
            </tr>
        </table>
        <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
            <tr>
                <td style="text-align: left">搜索文章：<input type="text" name="keyword" class="keyword"/><input type="button" class="search_article"  value="搜索"/></td>
            </tr>
            <tr>
                <td style="text-align: left;width: 50%">
                    <select multiple="multiple" class="left_select" style="width: 80%;height:300px">
                    </select>
                </td>
                <td  style="text-align: left">
                    <div class="hiddenSelecte">
                        <?php if(is_array($goodsAritcles)): $i = 0; $__LIST__ = $goodsAritcles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goodsAritcle): $mod = ($i % 2 );++$i;?><input type="hidden" name="article_id[]" value="<?php echo ($goodsAritcle["id"]); ?>"/><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <select multiple="multiple" class="right_select" style="width: 80%;height: 300px">
                        <?php if(is_array($goodsAritcles)): $i = 0; $__LIST__ = $goodsAritcles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goodsAritcle): $mod = ($i % 2 );++$i;?><option value="<?php echo ($goodsAritcle["id"]); ?>"><?php echo ($goodsAritcle["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>
        </table>

        <div style="text-align: center"><br/>
            <input type="hidden" name="id" value="<?php echo ($id); ?>" class="button"/>
            <input type="submit" class="button" value=" 确定 "/>
            <input type="reset" class="button" value=" 重置 "/>
        </div>
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
    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/uploadify/jquery.uploadify.js"></script>
    <script type="text/javascript" charset="utf-8" src="http://admin.shop.com/Public/Admin/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="http://admin.shop.com/Public/Admin/ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="http://admin.shop.com/Public/Admin/ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript">
        $(function () {
            //是否上架设置默认值
            $('.is_on_sale').val([1]);
            //编辑时显示货号
            <?php if(!empty($id)): ?>$('.sn').val([<?php echo ($sn); ?>]);<?php endif; ?>


            //给标题span添加点击事件，改变有二
            $('#tabbar-div span').click(function () {
                //1 改变标签样式，即是属性class
                $('#tabbar-div span').removeClass('tab-front').addClass('tab-back');
                $(this).removeClass('tab-back').addClass('tab-front');
                //2  改变显示不同表格
                $('form>table').hide();  //隐藏所有
                var index=$(this).index();
                $('form>table').eq(index).show(); //显示点击的标签


                //点击商品描述，生成文本编辑器
                if(index==1){
                    UE.getEditor('intro',{
                        //编辑器配置
                    });
                }

            });



            //1 树的设置
            var setting = {
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: "parent_id", //设置parent_id
                    }
                },
                callback: {
                    beforeClick:function(treeId, treeNode,clickFlag){
//                        console.debug(treeNode);
                        if(treeNode.isParent){
                            layer.msg('必须选择最小分类', {
                                offset: 0,
                                icon:0,  //设置提示图片
                            });
                        }
                        return !treeNode.isParent;
                    },
                    onClick: function(event, treeId, treeNode){
//                        console.debug(treeNode);
                        $('.goods_category_id').val(treeNode.id);
                        $('.goods_category_text').val(treeNode.name);
                    }
                }
            };
            //2 准备数据{ id:1, pId:0, name:"父节点1 - 展开", open:true},
            var zNodes =<?php echo ($nodes); ?>;  //注意比对例子中的数据和自己传的数据  parent_id不同
            //3  定义树的对象
            var treeObject =$.fn.zTree.init($("#treeDemo"), setting, zNodes);
            //4  使用对象中的方法让其展开  分类树全部展开
            treeObject.expandAll(true);

            //编辑时，选中分类
            <?php if(!empty($id)): ?>//            if(<?php echo ($goods_category_id); ?>==0){
//                return;
//            }
            var goods_category_id = <?php echo ($goods_category_id); ?>;
            var node  = treeObject.getNodeByParam('id',goods_category_id);
            treeObject.selectNode(node);
            //并且将选中的节点的id,name设置
            $('.goods_category_id').val(node.id);
            $('.goods_category_text').val(node.name);
            <?php else: ?>
            //>>4.使用对象中的方法让其展开
            treeObject.expandAll(true);<?php endif; ?>



            //上传图片的插件
            window.setTimeout(function(){
                $("#upload-logo").uploadify({
                    height        : 25,    //指定删除插件的高和宽
                    width         : 145,
                    swf           : 'http://admin.shop.com/Public/Admin/uploadify/uploadify.swf',  //指定swf的地址
                    uploader      : '<?php echo U("Uploader/index");?>',   //在服务器上处理上传的代码
                    'buttonText' : '选择图片',   //上传按钮上面的文字
                    'fileSizeLimit' : '100KB',  //限制大小
//            'fileObjName' : 'the_files',  //上传文件时, name的值 ,  默认值为  Filedata     $_FIELS['Filedata']
                    'formData'      : {'dir' : 'brand'},   //通过post方式传递的额外参数
                    'multi'    : true,   //是否支持多文件上传
                    'onUploadSuccess' : function(file, data, response) {   //上传成功时执行的方法
//                alert(data);
                        $('.logo').val(data);
                        $('.upload-img-box').show();
                        $('.upload-img-box img').attr('src',"/Uploads/"+data);
                    },
                    'onUploadError' : function(file, errorCode, errorMsg, errorString) {   //上传失败时该方法执行
                        alert('该文件上传失败!错误信息为:' + errorString);
                    }
                });
            },10)




            /////////////////////////////编辑时回显商品状态  开始////////////////////////////////////////////
            <?php if(!empty($id)): ?>var goods_status = <?php echo ($goods_status); ?>;  //该值是一个整数
            var goods_status_values = new Array();
            if((goods_status & 1) > 0){
                goods_status_values.push(1);
            }
            if((goods_status & 2) > 0){
                goods_status_values.push(2);
            }
            if((goods_status & 4) > 0){
                goods_status_values.push(4);
            }
            $('.goods_status').val(goods_status_values);<?php endif; ?>
            /////////////////////////////编辑时回显商品状态   结束////////////////////////////////////////////



            ////////////////商品相册///////////////////
                //上传图片的插件
            window.setTimeout(function(){
                $("#upload-gallery").uploadify({
                    height        : 25,    //指定删除插件的高和宽
                    width         : 145,
                    swf           : 'http://admin.shop.com/Public/Admin/uploadify/uploadify.swf',  //指定swf的地址
                    uploader      : '<?php echo U("Uploader/index");?>',   //在服务器上处理上传的代码
                    'buttonText' : '选择图片',   //上传按钮上面的文字
                    'fileSizeLimit' : '100KB',  //限制大小
//            'fileObjName' : 'the_files',  //上传文件时, name的值 ,  默认值为  Filedata     $_FIELS['Filedata']
                    'formData'      : {'dir' : 'goods'},   //通过post方式传递的额外参数
                    'multi'    : true,   //是否支持多文件上传
                    'onUploadSuccess' : function(file, data, response) {   //上传成功时执行的方法
                        var itemhtml='<div class="upload-pre-item" style="display: inline-block">\
                                    <input type="hidden" name="gallery_path[]" value="'+data+'">\
                                    <img src="/Uploads/'+data+'">\
                                    <a href="javascript:;">x</a>\
                                </div>';
                        $('.upload-gallery-box').append(itemhtml);
                    },
                    'onUploadError' : function(file, errorCode, errorMsg, errorString) {   //上传失败时该方法执行
                        alert('该文件上传失败!错误信息为:' + errorString);
                    }
                });
            },10)

            //删除商品相册的数据,存在数据库发送ajax请求，不存在则在页面直接删除
            $('.upload-gallery-box').on('click','a',function(){
                //>>1.判定该图片是否在数据库中存在
                var dbid = $(this).attr('dbid');  //存在dbid说明是编辑回显的图片，在数据库中
                if(dbid){
                    var that = $(this);//当前对象a标签
                    //>>2. 如果存在,需要发送ajax请求让服务器删除数据库中数据
                    $.post('<?php echo U("deleteGallery");?>',{gallery_id:dbid},function(data){
                        if(data.success){
                            that.closest('div').remove();
                        }
                    });
                }else{
                    //>>3.如果不存在直接从页面上删除
                    $(this).closest('div').remove();
                }
            });



            ///////////////////////////////商品关联文章/////////////////////////////////
            //搜索框中按回车搜索
            $('.keyword').keypress(function(event){
                if(event.keyCode==13){
                    searchArticle();
                    return false;
                }
            });

            //搜索文章，显示到左侧下拉菜单
            $('.search_article').click(function(){
               searchArticle();
            });
            function searchArticle(){
                //清空左侧下拉菜单
                $('.left_select').empty();
                //发送ajax请求
                $.getJSON('<?php echo U("Article/search");?>',{keyword:$('.keyword').val()},function(rows){
                    var html='';
                    $(rows).each(function(){
                        html="<option value='"+this.id+"'>"+this.name+"</option>";
                    });
                    $('.left_select').append(html);
                });
            }

            //双击选项，互换位置
            $('.left_select').on('dblclick','option',function(){
                $('.right_select').append($(this));
                select2Hidden();
            });
            $('.right_select').on('dblclick','option',function(){
                $('.left_select').append($(this));
                select2Hidden();
            });
            //将当前右侧下拉菜单选项添加到隐藏下拉菜单
            function select2Hidden(){
                var html='';
                $('.right_select option').each(function(){
                    html="<input type='hidden' name='article_id[]' value='"+this.value+"'/>";
                });
                $('.hiddenSelecte').empty();
                $('.hiddenSelecte').append(html);
            }



        });
    </script>

</body>
</html>