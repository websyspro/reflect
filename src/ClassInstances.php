<?php

namespace Websyspro\Reflect
{
  use ReflectionClass;

  class ClassInstances
  {
    function __construct(
      public object | string $objectOrClass
    ){}

    function New(): mixed {
      return call_user_func_array([
        new ReflectionClass($this->objectOrClass), "newInstance"
      ], []);
    }
  }
}