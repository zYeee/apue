<?php

//Decouple an abstraction from its implementation so that the two can vary
//independently.
interface Implementor {
  public function doSomething();
  public function doAnything();
}

class ConcreteImplementor1 implements Implementor
{
  public function doSomething(){
    echo "do Something1";
  }

  public function doAnything(){
    echo "do Anything1";
  }
}

class ConcreteImplementor2 implements Implementor
{
  public function doSomething(){
    echo "do Something2";
  }

  public function doAnything(){
    echo "do Anything2";
  }
}

abstract class Abstraction 
{
  private $imp;

  public function __construct(Implementor $_imp){
    $this->imp = $_imp;
  }

  public function request() {
    $this->imp->doSomething();
  }

  public function getImp() {
    return $this->imp;
  }
}

class RefinedAbstraction extends abstraction
{
  public function request() {
    parent::request();
    parent::getImp()->doAnything();
  }
}

$imp = new ConcreteImplementor1;
$ref = new RefinedAbstraction($imp);
$ref->request();
