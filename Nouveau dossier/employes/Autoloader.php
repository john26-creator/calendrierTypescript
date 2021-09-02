<?php

class Autoloader {
    static function register () {
        spl_autoload_register(array(__CLASS__  , 'autoload' ));
    }

    static function autoload ($className) {
        require_once $_SERVER['DOCUMENT_ROOT'] .'/employes/model/' . $className . '.php';
    }
}