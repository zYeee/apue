<?php
namespace woo\command;

class test extends command{
  function doExecute( \woo\controller\Request $request ){
    echo "just for test";
  }
}
