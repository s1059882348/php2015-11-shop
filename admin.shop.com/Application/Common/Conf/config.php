<?php
return array(
    //数据库连接配置
    'DB_TYPE'=>'mysql',
    'DB_HOST'=>'127.0.0.1',
    'DB_NAME'=>'shop',
    'DB_USER'=>'root',
    'DB_PWD'=>'admin',
    'DB_PORT'=>'3306',

    //开启页面调试
//    'SHOW_PAGE_TRACE'=>true,
     //默认模板引擎
    'TMPL_ENGINE_TYPE'=>'Think',

    //文件上传配置
//    'UPLOAD_CONFIG'=>array(
//        'maxSize'=> 0, //上传的文件大小限制
//        'exts'=>  array('jpg', 'gif', 'png', 'jpeg'), //允许上传的文件后缀
//        'subName'=> array('date', 'Y-m-d'), //子目录创建方式
//        'savePath'=> '/goods/', //保存路径
//    ),

    //分页配置
    'PAGE_SIZE'=>5,  //每页记录条数
);