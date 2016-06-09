<?php
spl_autoload_register('autoload');

function autoload($className){
    $class = str_replace('\\', '/', $className) . '.php';
    include_once($class);
}
