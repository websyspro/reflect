<?php

namespace Websyspro\Reflect\Attributes
{
use Attribute;

  #[Attribute(Attribute::TARGET_CLASS)]
  class Authenticate
  {
    function __construct(){}
  }
}