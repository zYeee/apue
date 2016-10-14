<?php

//Provide a unified interface to a set of interfaces in a subsystem.facade
//defines a higher-level interface that makes the subsystem easier to use

class ClassA{
  public function doSomethingA(){
    echo "do something A\n";
  }
}

class ClassB{
  public function doSomethingB(){
    echo "do something B\n";
  }
}

class ClassC{
  public function doSomethingC(){
    echo "do something C\n";
  }
}

class Facade{

  private $clsa;
  private $clsb;
  private $clsc;

  public function __construct(){
    $this->clsa = new ClassA();
    $this->clsb = new ClassB();
    $this->clsc = new ClassC();
  }

  public function methodA(){
    $this->clsa->doSomethingA();
  }

  public function methodB(){
    $this->clsb->doSomethingB();
  }

  public function methodC(){
    $this->clsc->doSomethingC();
  }
}

