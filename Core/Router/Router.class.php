<?php

namespace Core\Router;

/**
 * 路由解析
 * /controller/method/
 * @author ranhai
 */
class Router {

    private $pathInfo; //请求路径
    private $className;
    private $method;

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
            exit('路径错误');
        }
        $params = explode('/', $this->pathInfo);
        $num = count($params);
        $this->className = $params[$num - 1];
        $this->method = $params[$num - 2];
    }

    private function checkControllerPath() {
        if (!$this->className) {
            die($this->className . 'Controller不存在');
        }
        $controllerPath = __APP__ . '/Controller/' . $this->className . 'Controller.class.php';
        if (!file_exists($controllerPath)) {
            die($controllerPath . '文件不存在');
        }
    }

}
