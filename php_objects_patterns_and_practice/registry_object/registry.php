<?php
class Registry{
    private static $instance;
    private $values = array();

    private function __construct(){}

    static function getInstance(){
        if(!(self::$instance instanceof self)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get($key){
        if(isset($this->values[$key])){
            return $this->values[$key];
        }
        return null;
    }
    public function set($key, $value){
        $this->values[$key] = $value;
    }
}


