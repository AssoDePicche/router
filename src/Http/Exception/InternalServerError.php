<?php

declare(strict_types=1);

namespace Http\Exception;

use ErrorException;
use Http\Enum\StatusCode;

final class InternalServerError extends ErrorException
{
  public function __construct()
  {
    $this->message = 'Internal Server Error';

    $this->code = StatusCode::INTERNAL_SERVER_ERROR;
  }
}
