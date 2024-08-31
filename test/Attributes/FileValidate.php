<?php

namespace Websyspro\Reflect\Attributes
{
use Attribute;

  #[Attribute(Attribute::TARGET_METHOD)]
  class FileValidate
  {
    function __construct(
      private string $fileType 
    ){}

    function Execute(): mixed {
      return [];
    }
  }
}