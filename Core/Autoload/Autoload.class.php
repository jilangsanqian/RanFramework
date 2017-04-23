<?php

namespace Core\Autoload;

/**
 * 自动加载类
 *
 * @author ranhai
 */
use DirectoryIterator;

class Autoload {

    public function loadFile($files, $basePath) {
        $path = $basePath . '/';
        foreach ($files as $file) {
            $filePath = $path . $file . '/';
            foreach (new DirectoryIterator($filePath) as $fileInfo) {
                if ($fileInfo->isExecutable() && !$fileInfo->isDot()) {
                    if ($fileInfo->isDir()) {
                        $this->loadFile([$file . '/' . $fileInfo->getBasename()], $basePath);
                    }
                    if ($fileInfo->isFile()) {
                        $this->requireFile($fileInfo->getPathname());
                    }
                }
            }
        }
        return true;
    }

    private function requireFile($file) {
        require $file;
    }
    function dd(){
        echo 111;
    }
}
