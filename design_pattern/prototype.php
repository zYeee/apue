<?php
//Specify the kinds of objects to create using a prototypical instance,
//and create new objects by copying this prototype
interface Prototype{
  public function copy();
}

class ConcreatePrototype implements Prototype{
  private $name;

  function __construct($name){
    $this->name = $name;
  }

  function getName(){
    return $this->name;
  }

  function setName($name){
    $this->name = $name;
  }

  function copy(){
    return clone $this;
  }
}

$pro = new ConcreatePrototype("prototype");
$pro2 = $pro->copy();
$pro2->setName("test");
echo $pro->getName();
echo $pro2->getName();
