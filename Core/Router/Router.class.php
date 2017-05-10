<?php

namespace Core\Router;

/**
 * 路由解析
 * /controller/method/
 * @author ranhai
 */
class Router {

    public $pathInfo; //请求路径
    public $className;
    public $method;

    public function __construct() {
        $queryString = $_SERVER['REQUEST_URI'];
        $this->getPathInfo($queryString);
        $this->pathExplode();
        $this->checkControllerPath();
    }

    private function getPathInfo($queryString) {
        $num = strpos($queryString, '?');
        if ($num !== false) {
            $queryString = substr($queryString, 0, $num);
        }
        $this->pathInfo = $queryString;
    }

    private function pathExplode() {
        if (!$this->pathInfo) {
            exit('path info error');
        }
        $params = array_filter(explode('/', trim($this->pathInfo,'/')));
        if(empty($params)){
            $this->className = defultController;
            $this->method = defultMethod;
            return false;
        }
        $this->className =  $params[0];
        $this->method = isset($params[1]) && $params[1] ? $params[1] : defultMethod;
    }

    private function checkControllerPath() {
        if (!$this->className) {
            die($this->className . ' Controller not exists');
        }
        $controllerPath = __APP__ . '/Controller/' . $this->className . 'Controller.class.php';
        if (!file_exists($controllerPath)) {
            die($controllerPath . ' not exists');
        }
    }

}