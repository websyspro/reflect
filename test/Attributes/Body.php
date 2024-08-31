<?php

namespace Websyspro\Reflect\Attributes
{
  use Attribute;
  
  #[Attribute(Attribute::TARGET_PARAMETER)]

  class Body
  {
    public function __construct(
    ){}

    public function Execute(
    ): array {
      return [ "Test Body" ];
    }  
  }
}