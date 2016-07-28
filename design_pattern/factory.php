<?php
//Define an interface for creating an object,but let subclasses decide which class to instantiate.
//Factory Method lets a class defer instantiation to subclasses.

interface Human{
  public function getColor();
  public function talk();
}
class BlackHuman implements Human{
  public function getColor(){
    echo "he is black!";
  }
  public function talk(){
    echo "black man saying!";
  }
}
class YellowHuman implements Human{
  public function getColor(){
    echo "he is yellow";
  }
  public function talk(){
    echo "yellow man saying!";
  }
}
class WhiteHuman implements Human{
  public function getColor(){
    echo "he is White";
  }
  public function talk(){
    echo "White man saying!";
  }
}

//simple Factory not need a abstract class
abstract class AbstractHumanFactory{
  abstract function createHuman($color);
}
class HumanFactory extends AbstractHumanFactory{
  public function createHuman($color){
    $class = ucfirst($color)."Human";
    return new $class;
  }
}

$humanFactory = new HumanFactory();
$human = $humanFactory->createHuman("white");
$human->getColor();
$human->talk();
