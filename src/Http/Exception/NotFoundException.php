<?php

declare(strict_types=1);

namespace Http\Exception;

use Http\Enum\StatusCode;
use RuntimeException;

final class NotFoundException extends RuntimeException
{
  public function __construct()
  {
    $this->message = 'Not Found';

    $this->code = StatusCode::NOT_FOUND;
  }
}
