<?php

//Provide a surrogate or placeholder for another object to control access to it

interface Subject{
  public function request();
}

class RealSubject implements Subject{
  public function request(){
    echo "hello";
  }
}

class Proxy implements Subject{
  private $subject;

  public function __construct(Subject $_subject){
    $this->subject = $_subject;
  }

  public function request(){
    $this->before();
    $this->subject->request();
    $this->after();
  }

  private function before(){

  }
  private function after(){

  }
}
