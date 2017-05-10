<?php
namespace Core;

/**
 * Description of RanController
 * @Time 2017-5-9 18:17:21
 * @author ranhai
 */
/****
 * 所有子类控制器必须继承父类控制器
 * 
 * ***/
class RanController
{
    static $app;
    //将router/session/cache/log/request/respone绑定到控制器
    
    static  $c = 1;
    public function  __get($name){
        
    }
    public function __construct($app)
    {
        self::$app = $app;
    }
    
}
