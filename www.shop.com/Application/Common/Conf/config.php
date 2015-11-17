<?php
return array(
    //数据库连接配置
    'DB_TYPE'=>'mysql',
    'DB_HOST'=>'127.0.0.1',
    'DB_NAME'=>'shop',
    'DB_USER'=>'root',
    'DB_PWD'=>'admin',
    'DB_PORT'=>'3306',


//    'DATA_CACHE_TYPE'        => 'Reids', // 数据缓存类型
//    'DATA_CACHE_PREFIX'      => '', // 缓存前缀
//    'REDIS_HOST'             =>'127.0.0.1',
//    'REDIS_PORT'             =>'6379',

    'MAIL_CONFIG'            =>array(
        'Host' => 'smtp.126.com',                    // 设置邮件的服务器
        'Username' => 'itsource520@126.com',              // 登陆用户的用户名
        'Password' => 'qqitsource520',
        'From' => 'itsource520@126.com',
    )

);