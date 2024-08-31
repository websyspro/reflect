<?php

namespace Websyspro\Reflect\Attributes
{
  use Attribute;

  #[Attribute(Attribute::TARGET_METHOD)]
  class HttpPost
  {
    function __construct(
      private string $route
    ){}

    function Execute(): mixed {
      return [
        "route" => $this->route
      ];
    }
  }
}