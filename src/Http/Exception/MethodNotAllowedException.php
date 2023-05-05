<?php

declare(strict_types=1);

namespace Http\Exception;

use Http\Enum\StatusCode;
use RuntimeException;

final class MethodNotAllowedException extends RuntimeException
{
  public function __construct()
  {
    $this->message = 'Method Not Allowed';

    $this->code = StatusCode::METHOD_NOT_ALLOWED;
  }
}
