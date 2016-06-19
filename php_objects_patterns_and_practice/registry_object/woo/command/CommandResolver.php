<?php
namespace woo\command;

class CommandResolver{
  private static $base_cmd;
  private static $default_cmd;

  public function __construct(){
    if(!self::$base_cmd){
      self::$base_cmd = new \ReflectionClass("\woo\commend\Command");
      self::$default_cmd = new DefaultCommand();
    }
  }

  public function getCommand( \woo\controller\Request $request ){
    $cmd = $request->getProperty( 'cmd' );
    $sep = DIRECTORY_SEPARATOR;
    if( ! $cmd  ){
      return self::$default_cmd;
    }
  }
}
