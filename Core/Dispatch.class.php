<?php

namespace Core;

/**
 * 所有文件调度器
 *
 * @author ranhai
 */
class Dispatch {

    protected $module;

    public function __construct($module) {
        var_dump($module);
        $this->module = $module;
    }

}
