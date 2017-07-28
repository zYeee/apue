<?php
//Compose objects into tree structures to represent part-whole hierarchies.
//Composite lets clients treat individual objects and compositions of objects 
//uniformly


abstract class Component{
  public function doSomething(){
    echo "do something\n";
  }
}

class Composite extends Component{
  private $componentList = array();

  public function add(Component $component){
    $this->componentList[] = $component;
  }

  public function remove(){
  }

  public function getChildren(){
    return $this->componentList;
  }
}

class Leaf extends Component{
}

$root = new Composite();
$branch = new Composite();
$leaf = new Leaf();

$root->add($branch);
$branch->add($leaf);

display($root);

function display(Component $root){
  foreach($root->getChildren() as $child){
    if($child instanceof Leaf){
      $child->doSomething();
    }
    else{
      display($child);
    }
  }
}

