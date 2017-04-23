<?php

namespace Core\Bootstrap;

/**
 * 注入容器
 * @author ranhai
 */
class Application {

    protected $binds;
    protected $instances;
    private $basePath;
    public function __construct($path) {
        $this->basePath = $path;
        spl_autoload_register([$this, 'register']);
    }

    public function bind($abstract, $concrete) {
       
        if ($concrete instanceof Closure) {
          
            $this->binds[$abstract] = $concrete;
        } else {
           
            $this->instances[$abstract] = $concrete;
        }
    }

    public function make($abstract, $parameters = []) {
     
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }
       
        array_unshift($parameters, $this);
        return call_user_func_array($this->binds[$abstract], $parameters);
    }

    public function register($className) {
        //  require $this->basePath . '/Autoload/Autoload.class.php';
        // (new \Core\Autoload\Autoload())->loadFile($compents, $this->basePath);
        require $className . '.class.php';
    }
}
