<?php
//Convert the interface of a class into another interface clients expect.
//Adapter lets classes work together that couldn't otherwise because of 
//incompatible interfaces


interface Target{
  public function request();
}

class ConcreteTarget implements Target{
  public function request(){
    echo "if you need any help, all me !";
  }
}

class Adapte{
  public function doSomething(){
    echo "i'm kind of busy, leave me alone.";
  }
}

class Adapter extends Adapte implements Target{
  public function request(){
    self::doSomething();
  }
}

$adapter = new Adapter();
$adapter->request();
