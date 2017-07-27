<?php
//Define an object that encapsulates how a set of objects interact.
//Mediator promotes loose coupling by keeping objects from referring to each
//other explicitly,and it lets you vary their interaction independently

abstract class Mediator{
  protected $c1;
  protected $c2;

  public function getC1(){
    return $this->c1;
  }

  public function setC1($c1){
    $this->c1 = $c1;
  }

  public function getC2(){
    return $this->c2;
  }

  public function setC2($c2){
    $this->c2 = $c2;
  }

  public abstract function doSomething1();
  public abstract function doSomething2();
}

class ConcreteMediator extends Mediator{
  public function doSomething1(){
    $this->c1->selfMethod1();
    $this->c2->selfMethod2();
  }

  public function doSomething2(){
    $this->c1->selfMethod1();
    $this->c2->selfMethod2();
  }
}

abstract class Colleague{
  protected $mediator;
  public function __construct(Mediator $_mediator){
    $this->mediator = $_mediator;
  }
}

class ConcreteColleaguel1 extends Colleague{
  public function __construct(Mediator $_mediator){
    parent::__construct($_mediator);
  }

  public function selfMethod1(){
    echo "c1->m1";
  }

  public function depMethod1(){
    $this->mediator->doSomething1();
  }
}

class ConcreteColleaguel2 extends Colleague{
  public function __construct(Mediator $_mediator){
    parent::__construct($_mediator);
  }

  public function selfMethod2(){
    echo "c2->m2";
  }

  public function depMethod2(){
    $this->mediator->doSomething2();
  }
}
