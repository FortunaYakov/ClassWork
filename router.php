<?php

class Router {
  const ROUTE_KEY = 'r';

  private $getArray;
  private $actionArray = [];

  public function __construct($getArray) {
    $this->getArray = $getArray;
  }

  public function attach($actionName, $action) {
    $this->actionArray[$actionName] = $action;
  }

  public function serve() {
    switch ($this->getArray[self::ROUTE_KEY]) {
      case '/':
        $this->actionArray['indexPage']->process();
        break;
      case '/post':
        $this->actionArray['postPage']->process($this->getArray['id']);
        break;

      default:
        header('location: /index.php?r=/');
        break;
    }
  }

  public function dump() {
    var_dump($this);
  }

}
