<?php
//Represent an operation to be performed on the elements of an object structure. 
//Visitor lets you define a new operation without changing the classes of the
//elements on which it operates

abstract class Element
{
  public abstract function doSomething();
  public abstract function accept(IVisitor $visitor);
}

class ConcreteElement1 extends Element
{
  public function doSomething(){
    echo "doSomething1\n";
  }

  public function accept(IVisitor $visitor){
    $visitor->visit1($this);
  }
}

class ConcreteElement2 extends Element
{
  public function doSomething(){
    echo "doSomething2\n";
  }

  public function accept(IVisitor $visitor){
    $visitor->visit2($this);
  }
}

interface IVisitor
{
  public function visit1(Element $ele);
  public function visit2(Element $ele);
}

class Visitor implements IVisitor
{
  public function visit1(Element $ele){
    $ele->doSomething();
  }
  public function visit2(Element $ele){
    $ele->doSomething();
  }
}

$e = new ConcreteElement1();
$e->accept(new Visitor);
