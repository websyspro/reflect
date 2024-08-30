<?php

namespace Websyspro\Reflect
{
  use ReflectionClass;

  class ClassAttributs
  {
    function __construct(
      public object | string $objectOrClass,
      public array $objectOrClassArgs = []
    ){}

    function New(): mixed {
      return call_user_func_array([
        new ReflectionClass($this->objectOrClass), "newInstance"
      ], $this->objectOrClassArgs );
    }
  }
}