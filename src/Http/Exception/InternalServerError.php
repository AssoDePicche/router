<?php

declare(strict_types=1);

namespace Http\Exception;

final class InternalServerError extends \ErrorException
{
  public function __construct()
  {
    $this->message = 'Internal Server Error';

    $this->code = 500;
  }
}
