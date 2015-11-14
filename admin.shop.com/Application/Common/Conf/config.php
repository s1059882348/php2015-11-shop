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

    //超级管理员
    'SUPER_USER'             =>'root',
    //无需验证即可展示的页面，登录页面和验证码页面
    'NO_CHECK_URL'           =>array('Login/checkLogin','Verify/index'),

    //Session的的配置，驱动为Redis
//    'SESSION_AUTO_START'	=>  true,	// 是否自动开启Session
//    'SESSION_TYPE'			=>  'Redis',	//session类型
//    'SESSION_PERSISTENT'    =>  1,		//是否长连接(对于php来说0和1都一样)
//    'SESSION_CACHE_TIME'	=>  1,		//连接超时时间(秒)
//    'SESSION_EXPIRE'		=>  0,		//session有效期(单位:秒) 0表示永久缓存
//    'SESSION_PREFIX'		=>  'sess_',		//session前缀
//    'SESSION_REDIS_HOST'	=>  '127.0.0.1', //分布式Redis,默认第一个为主服务器
//    'SESSION_REDIS_PORT'	=>  '6379',	       //端口,如果相同只填一个,用英文逗号分隔
    // 'SESSION_REDIS_AUTH'    =>  'redis123',    //Redis auth认证(密钥中不能有逗号),如果相同只填一个,用英文逗号分隔

    //cookie的配置
    'COOKIE_DOMAIN'          => '.shop.com', // Cookie有效域名   可以被所有的子域名网站所共享

    'URL_MODEL'              => 1,



);