<?php
namespace woo\controller;

class Controller{
    private $applicationHelper;
    private function __construct(){}

    public static function run(){
        $instance = new self();
        $instance->init();
        $instance->handleRequest();
    }

    public function init(){
        $applicationHelper = ApplicationHelper::getInstance();
        $applicationHelper->init();
    }

    public function handleRequest(){
        $request = new \woo\controller\Request();
        $cmd_r = new \woo\command\CommandResolver();
        $cmd = $cmd_r->getCommand($request);
        $cmd->execute($request);
    }
}
