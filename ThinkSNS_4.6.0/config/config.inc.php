<?php
if (!defined('SITE_PATH')) exit();
return array(
    // 数据库常用配置
    'DB_TYPE'       => 'mysql',       // 数据库类型

    'DB_HOST'   => 'demo-mysql.zhiyicx.com', //服务器地址
    'DB_NAME'   => 'thinksns_v4', // 数据库名
    'DB_USER'   => 'thinksns_v4', // 用户名
    'DB_PWD'    => 'Xu0OeSUhr5bl',  // 密码

    'DB_PORT'       => 3306,        // 数据库端口
    'DB_PREFIX'     => 'ts_',// 数据库表前缀（因为漫游的原因，数据库表前缀必须写在本文件）
    'DB_CHARSET'    => 'utf8',      // 数据库编码
    'SECURE_CODE'   => '2353955a7c8910f676',  // 数据加密密钥
    'COOKIE_PREFIX' => 'TS4_',      // # cookie

    'exchange_type' => 5,  //智播积分兑换比例 20161030 bs
);
