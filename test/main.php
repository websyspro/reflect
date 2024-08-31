<?php

use Websyspro\Reflect\Attributes\Authenticate;
use Websyspro\Reflect\Attributes\Body;
use Websyspro\Reflect\Attributes\FileValidate;
use Websyspro\Reflect\Attributes\HttpPost;
use Websyspro\Reflect\Attributes\Query;
use Websyspro\Reflect\Attributes\UserService;
use Websyspro\Reflect\Attributes\Varchar;
use Websyspro\Reflect\ClassLoader;
use Websyspro\Reflect\Attributes\Controller;

#[Controller("controller")]
#[Authenticate()]
class TMain
{
  #[Varchar(255)]
  public string $Path;

  function __construct(
    #[Body()] array $body,
    public \Websyspro\Reflect\Classes\UserService $userService
  ){}

  #[HttpPost("obter-todos")]
  #[FileValidate("png")]
  function ObterTodos(
    #[Body()] array $body,
    #[Query()] array $query
  ): array {
    return [];
  }
}

$classLoad = new ClassLoader(
  objectOrClass: TMain::class
);