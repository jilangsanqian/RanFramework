<?php

namespace Core;

/**
 * 此处应为IOC模式，注入各种需要用到的组件
 * 直接载入各种组件
 *
 * @author ranhai
 */
require __DIR__ . '/Bootstrap/di.class.php';
use Core\Dispatch;
//注入容器
class app
{

    protected $di;

    function __construct($di)
    {
        $this->di = $di;
    }

    function task($name)
    {
        return $this->di->get($name);
    }

}

$di = new \Core\Bootstrap\di();
$di->set('Router', function() {
    return new Router\Router();
});
$app = new app($di);
//$app->task('dg');
(new Dispatch($app))->send();