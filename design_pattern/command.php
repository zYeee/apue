<?php
//Encapsulate a request as an object,thereby letting you parameterize clients 
//with different requests,queue or log requests,and support undoable operations

abstract class Receiver{
  public abstract function doSomething();
}

class ConcretReciver1 extends Receiver{
  public function doSomething(){
    echo "Receiver1:do something";
  }
}

class ConcretReciver2 extends Receiver{
  public function doSomething(){
    echo "Receiver2:do something";
  }
}


abstract class Command{
  public abstract function execute();
}

class ConcreteCommand1 extends Command{
  private $receiver;
  public function __construct(Receiver $_receiver){
    $this->receiver = $_receiver;
  }
  public function execute(){
    $this->receiver->doSomething();
  }
}

class ConcreteCommand2 extends Command{
  private $receiver;
  public function __construct(Receiver $_receiver){
    $this->receiver = $_receiver;
  }
  public function execute(){
    $this->receiver->doSomething();
  }
}

class Invoker{
  private $command;
  public function setCommand(Command $_command){
    $this->command = $_command;
  }

  public function action(){
    $this->command->execute();
  }
}

$invoker = new Invoker();
$receive = new ConcretReciver1();
$command = new ConcreteCommand1($receive);

$invoker->setCommand($command);
$invoker->action();
