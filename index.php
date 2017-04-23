<?php

/* * **
 * ranhai
 * 20170422
 * *** */
define('__APP__', __DIR__ . '/App'); //定义应用目录路径


$app = require __DIR__ . '/Core/app.class.php';
//
//var_dump($app);



//spl_autoload_register(function($require) {
//    echo $require,'<br>';
//    require $require . '.class.php';
//});
//
//(new \Core\Bootstrap\Application())->dd();
/***

 * 1 路由解析
2 路由分配
3 IoC
4 数据库封装
5 cache封装
6 模版解析 文件cache
7 安全 xss sql注入
8 http 操作
9 图片操作
 *  */