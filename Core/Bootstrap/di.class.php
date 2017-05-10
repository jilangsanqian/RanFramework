<?php

namespace Core\Bootstrap;

/**
 * 注入容器
 * @author ranhai
 */
class di
{

    private $binds;

    public function __construct()
    {
        spl_autoload_register([$this, 'register']);
    }

    function set($name, $callBackFunc)
    {

        if (!$this->binds[$name]) {
            $this->binds[$name] = $callBackFunc;
        }
    }

    function get($name)
    {
        try { 
          if(!isset($this->binds[$name])){
               throw new \Exception('not exists');
           }
        } catch (\Exception $exc) {
            die($name.' ' .$exc->getMessage());
        }
        $callBackFunc = $this->binds[$name];
        if ($callBackFunc instanceof \Closure) {
            return call_user_func($callBackFunc);
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
    //自动加载
    public function register($className)
    {
        $className = __ROOT__.str_replace("\\", "/", $className);
        require $className . '.class.php';
    }

}
