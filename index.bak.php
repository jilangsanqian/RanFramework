<?php

/* * **
 * ranhai
 * 20170422
 * *** */
define('__APP__', __DIR__ . '/App'); //定义应用目录路径
//$app = require __DIR__ . '/Core/app.class.php';
//
//var_dump($app);
//spl_autoload_register(function($require) {
//    echo $require,'<br>';
//    require $require . '.class.php';
//});
//
//(new \Core\Bootstrap\Application())->dd();
/* * *

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

abstract class dbPrant
{

    abstract function query();
}

class db
{

    private static $instatice;

    function init(array $config)
    {
        $type = !isset($config['type']) || empty($config['type']) ? 'mysql' : $config['type'];
        unset($config['type']);

        return $this->content(new $type($config));
    }

    function content(dbPrant $db)
    {
        if (!self::$instatice || !(self::$instatice instanceof $db)) {
            self::$instatice = $db;
        }
        return self::$instatice;
    }

}

class mysql extends dbPrant
{

    static $host;
    static $username;
    static $password;
    static $dbname;
    static $instance;

    function __construct(array $dbConfig)
    {
        self::$dbname = $dbConfig['dbname'];
        self::$host = $dbConfig['host'];
        self::$username = $dbConfig['username'];
        self::$password = $dbConfig['password'];
        return $this;
    }

    function query()
    {
        echo 'yes';
    }

}

class pgsql extends dbPrant
{

    static $host;
    static $username;
    static $password;
    static $dbname;
    static $instance;

    function __construct(array $dbConfig)
    {
        self::$dbname = $dbConfig['dbname'];
        self::$host = $dbConfig['host'];
        self::$username = $dbConfig['username'];
        self::$password = $dbConfig['password'];
        return $this;
    }

    function query()
    {
        echo 'pgsql';
    }

}

/* * ****
 * 依赖注入
 * 
 * ***** */

class di
{

    private $binds;

    function set($name, $callBackFunc)
    {

        if (!$this->binds[$name]) {
            $this->binds[$name] = $callBackFunc;
        }
    }

    function get($name)
    {
        $callBackFunc = $this->binds[$name];
        if ($callBackFunc instanceof \Closure) {
            return call_user_func();
        }
        return $callBackFunc;
    }

    function __get($name)
    {
        $callBackFunc = $this->binds[$name];
        if ($callBackFunc instanceof \Closure) {
            return call_user_func($callBackFunc);
        }
        return $callBackFunc;
    }

}

//注入容器
class someCompontent
{

    protected $di;

    function __construct($di)
    {
        $this->di = $di;
    }

    function someDbTask($name)
    {
        return $this->di->$name;
    }

}

$di = new di();
$di->set('db', function() {
    return (new db())->init([
                'type' => 'pgsql',
                "host" => "localhost",
                "username" => "root",
                "password" => "secret",
                "dbname" => "invo",
                'port' => 3306,
    ]);
});

$some = new someCompontent($di);

$some->someDbTask('db')->query();
