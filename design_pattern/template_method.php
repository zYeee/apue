<?php
//Define the skeleton of an algorithm in an operation,deferring some steps to subclasses.Template Method lets subclasses redefine certain steps of an algorithm without changing the algorithm's structure.
abstract class HummerModel{
  protected abstract function start();
  protected abstract function stop();
  protected abstract function alarm();
  protected abstract function engineBoom();
  final public function run(){
    $this->start();
    $this->engineBoom();
    if($this->isAlarm()){
      $this->alarm();
    }
    $this->stop();
  }

  protected function isAlarm(){
    return true;
  }
}

class HummerH1Model extends HummerModel{
  private $alarmFlag = true;
  protected function start(){
    print_r("start\n");
  }
  protected function stop(){
    print_r("stop\n");
  }
  protected function alarm(){
    print_r("alarm\n");
  }
  protected function engineBoom(){
    print_r("engineBoom\n");
  }

  protected function isAlarm(){
    return $this->alarmFlag;
  }
  public function setAlarm($alarmFlag){
    $this->alarmFlag = $alarmFlag;
  }
}

$h1 = new HummerH1Model();
$h1->setAlarm(false);
$h1->run();
