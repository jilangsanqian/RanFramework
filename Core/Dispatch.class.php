<?php

namespace Core;

/**
 * 所有文件调度器
 *
 * @author ranhai
 */
use Core\app;
class Dispatch
{

    private static $app;
    private static $method;
    private static $className;

    public function __construct(app $app)
    {
        self::$app = $app;
    }

    public function send()
    {
        $this->startController();
    }

    //反射机制访问类
    private function startController()
    {
        $router = self::$app->task('Router');
        try {
            $reflector = new \ReflectionClass('App\Controller\\' . $router->className . 'Controller');
            //检测是否继承 父控制器
            $parentClass = $reflector->getParentClass();
            $method = $router->method;
            if (!$reflector->hasMethod($method)) {
                throw new \Exception('not exists method');
            }
            if (!$parentClass || !$parentClass->getName()) {
                throw new \Exception('No parent class');
            }
        } catch (\Exception $exc) {
            die($exc->getMessage());
        }
        $class = $reflector->newInstanceArgs([self::$app]);
        $class->$method();
        //$class->__init__(self::$app);
    }
  

    //将request/respone绑定到controller
}
