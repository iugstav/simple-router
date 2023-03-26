<?php
namespace Iugstav\Exceptions;

class NotFoundException extends \Exception
{
  public function __construct(string $className, int $code = 0, \Throwable $previous = null)
  {
    $message = sprintf("%s does not exists", $className);

    parent::__construct($message, $code, $previous);
  }
}