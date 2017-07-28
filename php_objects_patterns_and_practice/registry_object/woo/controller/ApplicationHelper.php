<?php
namespace woo\controller;

use woo\base\ApplicationRegistry;

class ApplicationHelper{
    private static $instance;

    private function __construct(){}

    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function init(){
        $dsn = ApplicationRegistry::getDsn();
    }
}
