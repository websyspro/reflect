<?php

namespace Websyspro\Reflect\Attributes
{
  use Attribute;

  #[Attribute(Attribute::TARGET_CLASS)]
  class Controller
  {
    function __construct(
      private string $controller
    ){}

    function Execute(){
      print_r($this->controller);
    }
  }
}