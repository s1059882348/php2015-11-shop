<?php
//定义资源服务器
define('WEB_URL','http://admin.shop.com');
return array(
    'TMPL_PARSE_STRING'=>array(
        '__CSS__'  =>WEB_URL.'/Public/Admin/css',
        '__JS__'   =>WEB_URL.'/Public/Admin/js',
        '__IMG__'  =>WEB_URL.'/Public/Admin/images',
        '__LAYER__' => WEB_URL.'/Public/Admin/layer/layer.js',
        '__UPLOADIFY__' => WEB_URL.'/Public/Admin/uploadify',
        '__BRAND__' => '/Uploads',   //brand表的图片保存路径
        '__GOODS__' => '/Uploads',   //goods表的图片保存路径
        '__TREEGRID__'=>WEB_URL.'/Public/Admin/treegrid',
        '__ZTREE__'=>WEB_URL.'/Public/Admin/zTree',
        '__UEDITOR__'=>WEB_URL.'/Public/Admin/ueditor',
    ),

    'LANG_SWITCH_ON' => true,   // 开启语言包功能
    'LANG_AUTO_DETECT' => true, // 自动侦测语言  ,如果第一次访问我的网站, thinkphp根据浏览器中设置的语言选择语言文件
    'LANG_LIST'        => 'zh-cn,en-us,zh-tw', // 允许切换的语言列表 用逗号分隔
    'VAR_LANGUAGE'     => 'l', // 默认语言切换变量

);