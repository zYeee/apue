<?php
//Without violating encapsulation,capture and externalize an object's internal
//state so that the object can be restored to this state later.

class Originator
{
  private $state;

  public function getState(){
    return $this->state;
  }

  public function setState($state){
    $this->state = $state;
  }

  public function createMemento(){
    return new Memento($this->state);
  }

  public function restoreMemento(Memento $_memento){
    $this->setState($_memento->getState());
  }
}

class memento
{
  private $state;
  public function __construct($_state){
    $this->state = $_state;
  }
  public function getState(){
    return $this->state;
  }
  public function setState($_state){
    $this->state = $_state;
  }
}

class Caretaker
{
  private $memento;
  public function getMemento(){
    return $this->memento;
  }

  public function setMemento(Memento $_memento){
    $this->memento = $_memento;
  }
}

$originator = new Originator();
$caretaker = new Caretaker();
$caretaker->setMemento($originator->createMemento());
$originator->restoreMemento($caretaker->getMemento());
