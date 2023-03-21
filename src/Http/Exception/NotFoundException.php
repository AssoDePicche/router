<?php

declare(strict_types=1);

namespace Http\Exception;

final class NotFoundException extends \RuntimeException
{
  public function __construct()
  {
    $this->message = 'Not Found';

    $this->code = 404;
  }
}
