<?php
namespace woo\command;

class DefaultCommand extends Command{
  function doExecute ( \woo\controller\Request $request ){
    $request->addFeedback("Welcome wo WOOOO");
    include( "woo/view/main.php" );
  }
}
