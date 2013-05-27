<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jean-Mi
 * Date: 21/04/13
 * Time: 00:48
 * To change this template use File | Settings | File Templates.
 */
spl_autoload_register(function ($class) {
    $namespace = explode('\\', $class);

    $path = __DIR__.'/'.implode('/', $namespace).'.php';
    if (file_exists($path)) {
        include $path;
    }
});