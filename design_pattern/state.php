<?php
//Allow an object to alter its behavior when its internal state changes.
//The object will appear to change its class
abstract class State {

  protected $context;

  public function setContext(Context $_context){
    if(!$this->hasContext()){
      $this->context = $_context;
    }
  }

  private function hasContext(){
    return $this->context ? true : false;
  }

  abstract public function handle1();
  abstract public function handle2();
  
}

class ConcreteState1 extends State {
  public function handle1(){
    echo "state1--->handle1\n";
  }
  public function handle2(){
    $this->context->setCurrentState(Context::$STATE2);
    $this->context->handle2();

  }
}

class ConcreteState2 extends State {
  public function handle1(){
    $this->context->setCurrentState(Context::$STATE1);
    $this->context->handle1();
  }
  public function handle2() {
    echo "state2--->handle2\n";
  }
}

class Context {
  public static $STATE1;
  public static $STATE2;

  private $CurrentState;

  public function __construct() {
    self::$STATE1 = new ConcreteState1();
    self::$STATE2 = new ConcreteState2();
  }

  public function getCurrentState() {
    return $this->CurrentState;
  }
  public function setCurrentState(State $_currentState) {
    $this->CurrentState = $_currentState;
    $this->CurrentState->setContext($this);
  }

  public function handle1() {
    $this->CurrentState->handle1();
  }

  public function handle2() {
    $this->CurrentState->handle2();
  }
}

$context = new Context();
$context->setCurrentState(Context::$STATE1);
$context->handle1();
$context->handle2();
$context->handle1();
