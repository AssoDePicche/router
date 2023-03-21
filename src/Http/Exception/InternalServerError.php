<?php

declare(strict_types=1);

namespace Http;

final class InternalServerError extends \Error
{
  public function __construct()
  {
    $this->message = 'Internal Server Error';

    $this->code = 500;
  }
}
