<?php

namespace Websyspro\Reflect\Attributes
{
  use Attribute;

  #[Attribute(Attribute::TARGET_PROPERTY)]
  class Varchar
  {
    function __construct(
      private int $size = 0
    ){}

    function Execute(
    ): mixed {
      return [
        "type" => "varchar({$this->size})"
      ];
    }
  }
}