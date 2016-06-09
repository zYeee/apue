<?php
namespace woo\base;

class ApplicationRegistry extends Registry
{
    private static $instance;
    private $freezedir = "data";
    private $values = [];
    private $mtimes = [];

    private function __construct(){}

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function get( $key ){
        $path = $this->freezedir . DIRECTORY_SEPARATOR. $key;
        if(file_exists($path)){
            clearstatcache();
            $mtime=filemtime($path);
            if(!isset($this->mtimes[$key])){
                $this->mtimes[$key] = 0;
            }
            if($mtime > $this->mtimes[$key]){
                $data = file_get_contents($path);
                $this->mtimes[$key] = $mtime;
                return ($this->values[$key] = unserialize($data));
            }
        }
        if(isset($this->values[$key])){
            return $this->values[$key];
        }
        return null;
    }

    protected function set($key, $val){
        $this->values[$key] = $val;
        $path = $this->freezedir . DIRECTORY_SEPARATOR. $key;
        file_put_contents($path, serialize($val));
        $this->mtimes[$key] = time();
    }

    public static function getDsn(){
        return self::getInstance()->get('dsn');
    }

    public static function setDsn($dsn){
        return self::getInstance()->set('dsn', $dsn);
    }
}

echo ApplicationRegistry::getDsn();

