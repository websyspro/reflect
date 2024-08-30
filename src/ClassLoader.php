<?php

namespace Websyspro\Reflect
{
  use ReflectionClass;
  use ReflectionAttribute;
  use ReflectionProperty;
  use Websyspro\Common\Utils;

  class ClassLoader
  {
    public ReflectionClass $reflectionClass;
    public array $reflectClassAttributes = [];
    public array $reflectClassProperties = [];

    function __construct(
      public string $objectOrClass
    ){
      $this->ObterReflectClass();
      $this->ObterReflectClassAttributs();
      $this->ObterReflectClassProperties();

      print_r($this);
    }

    private function ReflectClass(
      string $objectOrClass
    ): ReflectionClass {
      return new ReflectionClass(
        objectOrClass: $objectOrClass
      );
    }

    private function ObterReflectClass(): void {
      $this->reflectionClass = $this->ReflectClass(
        $this->objectOrClass
      );
    }

    private function ObterClassAttributes(
      ReflectionAttribute $reflectionAttribute
    ): ClassAttributs {
      return new ClassAttributs(
        objectOrClass: $reflectionAttribute->getName(),
        objectOrClassArgs: $reflectionAttribute->getArguments()
      );
    }

    private function ObterReflectClassAttributs(
    ): void {
      Utils::Mapper($this->reflectionClass->getAttributes(), 
        fn( ReflectionAttribute $reflectionAttribute ) => (
          $this->reflectClassAttributes[] = $this->ObterClassAttributes($reflectionAttribute)
        )
      );
    }

    private function ObterReflectClassProperties(
    ): void {
      Utils::Mapper($this->reflectionClass->getProperties(),
        fn( ReflectionProperty $properties ) => Utils::Mapper( $properties->getAttributes(), 
          fn( ReflectionAttribute $reflectionAttribute) => (
            $this->reflectClassProperties[] = $this->ObterClassAttributes($reflectionAttribute)
          )
        )
      );
    }
  }
}