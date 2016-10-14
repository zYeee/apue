<?php

//Define a one-to-many dependency between objects so that when one object 
//changes state,all its dependents are notified and updated automatically

abstract class Subject{
  private $obsArr = array();

  public function addObserver(Observer $obs){
    $this->obsArr[] = $obs;
  }

  public function notifyObservers(){
    foreach($this->obsArr as $obs){
      $obs->update();
    }
  }
}

class ConcreteSubject extends Subject{
  public function doSomething(){
    echo "do something ~ \n";
    $this->notifyObservers();
  }
}

interface Observer{
  public function update();
}

class ConcreteObserver implements Observer{
  public function update(){
    echo "get the msg!";
  }
}

$concreteSubject = new ConcreteSubject();
$obs = new ConcreteObserver();
$concreteSubject->addObserver($obs);
$concreteSubject->doSomething();
