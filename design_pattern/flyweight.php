<?php
//Use sharing to support large numbers of fine-grained objects efficiently

abstract class Flyweight {
  private $intrinsic;

  protected $Extrinsic;

  public function __construct($_Extrinsic){
    $this->Extrinsic = $_Extrinsic;
  }

  public function getInrinsic(){
    return $this->intrinsic;
  }

  public function setInrinsic($intrinsic) {
    $this->intrinsic = $intrinsic;
  }

  public abstract function operate();
}

class ConcreteFlyweight1 extends Flyweight {
  public function operate(){
    echo "do concrete fly weight 1\n";
  }
}

class ConcreteFlyweight2 extends Flyweight {
  public function operate(){
    echo "do concrete fly weight 2\n";
  }
}

class FlyweightFactory {
  private static $pool = [];

  public static function getFlyweight($Extrinsic){
    $flyweight = null;

    if ($this->pool[$Extrinsic]){
      $flyweight = $this->pool[$Extrinsic];
    }
    else {
      $flyweight = new ConcreteFlyweight1($Extrinsic);
      $this->pool[$Extrinsic] = $flyweight;
    }
    return $flyweight;
  }
}
