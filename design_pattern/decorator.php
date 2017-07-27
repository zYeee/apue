<?php
//Attach additional responsibilities to an object dynamically keeping the same 
//interface.Decorators provide a flexible alternative to subclassing for 
//extending functionality

abstract class Component{
  public abstract function operate();
}

class ConcreteComponent extends Component{
  public function operate(){
    echo "do something\n";
  }
}

abstract class Decorator extends Component{
  private $component = null;

  public function __construct(Component $_component){
    $this->component = $_component;
  }

  public function operate(){
    $this->component->operate();
  }
}

class ConcreteDecorator1 extends Decorator{
  private function method(){
    echo "do something first\n";
  }
  public function operate(){
    $this->method();
    parent::operate();
  }
}

class ConcreteDecorator2 extends Decorator{
  private function method(){
    echo "do something last\n";
  }
  public function operate(){
    parent::operate();
    $this->method();
  }
}

$component = new ConcreteComponent();
$component = new ConcreteDecorator1($component);
$component = new ConcreteDecorator2($component);
$component->operate();
