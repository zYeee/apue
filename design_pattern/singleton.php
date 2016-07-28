<?php
//Ensure a class has only one instance, and provide a global point of access to it.
class Singleton{
  private static $_instance = null;
  private function __construct(){
    echo "new!\n";
  }
  private function __clone(){
  }
  public static function getInstance(){
    if(!(self::$_instance instanceof self)){
      self::$_instance = new self();
    }
    return self::$_instance;
  }
}

//only show "new!" once
Singleton::getInstance();
Singleton::getInstance();
Singleton::getInstance();
