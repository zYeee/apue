<?php

//Separate the construction of a complex object from its representation so that
//the same construction process can create different representations

class Product{
  public function doSomething(){
    echo "abc";
  }
}

abstract class Builder{
  abstract public function setPart();
  abstract public function buildProduct();
}

class ConcreteProduct extends Builder{
  public function __construct(){
    $this->product = new Product();
  }
  public function setPart(){

  }

  public function buildProduct(){
    return $this->product;
  }
}

class Director{
  private $build;

  public function __construct(){
    $this->build = new ConcreteProduct();
  }
  public function getAProduct(){
    $this->build->setPart();
    return $this->build->buildProduct();
  }
}

$director = new Director();
$p = $director->getAProduct();
$p->doSomething();
