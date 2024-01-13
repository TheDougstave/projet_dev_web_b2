<?php

namespace app\classes;

class Autoloader
{
    static function register(){
        spl_autoload_register(array(__CLASS__, 'load'));
    }

    static function load($class_name) 
    {
        if (strpos($class_name, __NAMESPACE__ . '\\') === 0){
            $class_name = str_replace(__NAMESPACE__ . '\\', '', $class_name);
            $class_name = str_replace('\\', '/', $class_name);
            require_once $class_name . '.php';
        }
    }
}