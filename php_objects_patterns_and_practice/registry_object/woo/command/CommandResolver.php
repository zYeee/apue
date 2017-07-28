<?php
namespace woo\command;

class CommandResolver{
  private static $base_cmd;
  private static $default_cmd;

  public function __construct(){
    if(!self::$base_cmd){
      self::$base_cmd = new \ReflectionClass("\woo\command\Command");
      self::$default_cmd = new DefaultCommand();
    }
  }

  public function getCommand( \woo\controller\Request $request ){
    $cmd = $request->getProperty( 'cmd' );
    $sep = DIRECTORY_SEPARATOR;
    if( ! $cmd  ){
      return self::$default_cmd;
    }

    $cmd = str_replace( [".", $sep], "", $cmd );
    $filepath = "woo{$sep}command{$sep}{$cmd}.php";
    $classname = "woo\\command\\{$cmd}";
    if(file_exists($filepath)){
      require($filepath);
      $cmd_class = new \ReflectionClass($classname);
      if($cmd_class->isSubClassOf(self::$base_cmd)){
        return $cmd_class->newInstance();
      }
    }

    return clone self::$default_cmd;
  }
}
