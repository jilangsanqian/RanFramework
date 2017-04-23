<?php

namespace Core;

/**
 * 此处应为IOC模式，注入各种需要用到的组件
 * 直接载入各种组件
 *
 * @author ranhai
 */
require __DIR__ . '/Bootstrap/Application.class.php';
//set_include_path($new_include_path)

$application = new \Core\Bootstrap\Application(__DIR__);
$application->bind('Dispath', function($application,$moduleName){
    return new \Core\Dispath($application->make($moduleName));
});
$application->bind('Router', function($application){
    return new \Core\Router\Router();
});
$superman_1 = $application->make('Dispath', ['Router']);
//(new Autoload\Autoload())->dd();

/*
$components = [
    'Request', // 'Response', 'Router', 'Session', 'Log', 'Eloquent', 'Cache'
];
$application->register($components);
*/