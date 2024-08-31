<?php

namespace Websyspro\Reflect
{
  use ReflectionClass;
  use ReflectionAttribute;
  use ReflectionMethod;
  use ReflectionParameter;
  use ReflectionProperty;
  use Websyspro\Common\Utils;

  class ClassReflectLoader
  {
    public ReflectionClass $reflectionClass;
    public array $reflectClassAttributes = [];
    public array $reflectClassProperties = [];
    public array $reflectClassMethods = [];

    function __construct(
      public string $objectOrClass
    ){
      $this->ObterReflectClass();
      $this->ObterReflectClassAttributs();
      $this->ObterReflectClassProperties();
      $this->ObterReflectClassMethodos();

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
            $this->reflectClassProperties[
              $properties->getName()
            ][] = $this->ObterClassAttributes($reflectionAttribute)
          )
        )
      );
    }

    private function ObterReflectClassMethod(
      string $method
    ): ReflectionMethod {
      return new ReflectionMethod(
        $this->objectOrClass, $method
      );
    }

    private function ObterReflectClassMethodAttributes(
      string $method
    ): array {
      return Utils::Mapper($this->ObterReflectClassMethod($method)->getAttributes(), 
        fn( ReflectionAttribute $reflectionAttribute) => (
          $this->ObterClassAttributes($reflectionAttribute)
        )
      );
    }

    private function IsValidAttributes(
      ReflectionParameter $reflectionParameter
    ): bool {
      return Utils::IsValidArray($reflectionParameter->getAttributes()) 
          && Utils::IsEmptyArray($reflectionParameter->getAttributes()) === false;
    }

    private function ObterReflectClassMethodProperties(
      string $method
    ): array {
      return Utils::Mapper( $this->ObterReflectClassMethod($method)->getParameters(),
        fn(ReflectionParameter $parameter) => Utils::ShitArray(
          $this->IsValidAttributes($parameter)
            ? Utils::Mapper($parameter->getAttributes(),
                fn( ReflectionAttribute $reflectionAttribute ) => (
                  $this->ObterClassAttributes($reflectionAttribute)
                )
              )
            : [ new ClassInstances($parameter->getType()->getName()) ]
        )
      );
    }

    private function ObterReflectClassMethodos(
    ): void {
      Utils::Mapper( get_class_methods($this->objectOrClass), fn(string $method) => (
        $this->reflectClassMethods[$method] = [
          "attributes"  => $this->ObterReflectClassMethodAttributes($method),
          "properties"  => $this->ObterReflectClassMethodProperties($method)
        ]
      ));
    }
  }
}