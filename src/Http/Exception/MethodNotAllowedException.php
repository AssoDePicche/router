<?php

declare(strict_types=1);

namespace Http\Exception;

final class MethodNotAllowedException extends \RuntimeException
{
  public function __construct()
  {
    $this->message = 'Method Not Allowed';

    $this->code = 405;
  }
}
