<?php
//Define a family of algorithms,encapsulate each one,and make them 
//interchangeable.

interface Strategy{
  public function doSomething();
}

class ConcreteStrategy1 implements strategy
{
  public function doSomething(){
    echo "strategy for rule 1\n";
  }
}

class ConcreteStrategy2 implements strategy
{
  public function doSomething(){
    echo "strategy for rule 2\n";
  }
}

class Context
{
  private $strategy;

  public function __construct(Strategy $_strategy){
    $this->strategy = $_strategy;
  }

  public function doAnything(){
    $this->strategy->doSomething();
  }
}

$test = new Context(new ConcreteStrategy1());
$test->doAnything();
