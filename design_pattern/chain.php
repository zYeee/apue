<?php
//Avoid coupling the sender of a request to its receiver by giving more than
//one object a chance to handle the request.Chain the receiving objects and
//pass the request along the chain until an object handles its
abstract class Handler{
  private $nextHandler;
  public final function handleMessage(Request $request){
    if($this->getHandlerLevel() == ($request->getRequestLevel())) {
      $response = $this->getResponse($request);
    }
    else{
      if($this->nextHandler != null){
        $response = $this->nextHandler->handleMessage($request);
      }
    }
    return $response;
  }

  public function setNext(Handler $_handler){
    $this->nextHandler = $_handler;
  }
  protected abstract function getHandlerLevel();
  protected abstract function getResponse(Request $request);
}

class ConcreteHandler1 extends Handler{
  protected function getResponse(Request $request){
    return null;
  }
  protected function getHandlerLevel(){
    return 1;
  }
}

class ConcreteHandler2 extends Handler{
  protected function getResponse(Request $request){
    return null;
  }
  protected function getHandlerLevel(){
    return 2;
  }
}
