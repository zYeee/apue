<?php
namespace woo\base;

class RequestRegistry extends Registry{
  private $values = array();
  private static $instance;

  private function __construct(){
  }

  static function getInstance(){
    if(!isset(self::$instance)){
      self::$instance = new self();
    }
    return self::$instance;
  }

  protected function get($key){
    if(isset ($this->values[$key])){
      return $this->values[$key];
    }
    return null;
  }

  protected function set($key, $val){
    $this->values[$key] = $val;
  }

  static function getRequest(){
    return self::getInstance()->get('request');
  }

  static function setRequest( \woo\controller\Request $request ){
    return self::getInstance()->set("request", $request);
  }
}
