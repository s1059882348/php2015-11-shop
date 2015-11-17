<?php
//定义资源服务器
define('WEB_URL','http://www.shop.com');
define('WEB_URL_ADMIN','http://admin.shop.com');
return array(
    'TMPL_PARSE_STRING'=>array(
        '__CSS__'  =>WEB_URL.'/Public/Home/css',
        '__JS__'   =>WEB_URL.'/Public/Home/js',
        '__IMG__'  =>WEB_URL.'/Public/Home/images',
        '__LAYER__' => WEB_URL.'/Public/Home/layer/layer.js',
        '__UPLOADIFY__' => WEB_URL.'/Public/Home/uploadify',
        '__BRAND__' => WEB_URL_ADMIN.'/Uploads',   //brand表的图片保存路径
        '__GOODS__' => WEB_URL_ADMIN.'/Uploads',   //goods表的图片保存路径
        '__TREEGRID__'=>WEB_URL.'/Public/Home/treegrid',
        '__ZTREE__'=>WEB_URL.'/Public/Home/zTree',
        '__UEDITOR__'=>WEB_URL.'/Public/Home/ueditor',
//        '__BRAND__' => "http://itsource-brand.b0.upaiyun.com", // brand又拍云空间中的地址
//        '__GOODS__' => "http://itsource-goods.b0.upaiyun.com", // goods又拍云空间中的地址
    ),


);