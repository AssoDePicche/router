<?php

declare(strict_types=1);

namespace Http;

final class Response
{
  public array $headers;

  public function __construct(
    public readonly mixed $content,
    public readonly int $statusCode = 200,
    public readonly string $contentType = 'text/html'
  ) {
    $this->headers['Content-Type'] = $contentType;
  }

  public function send(): never
  {
    http_response_code($this->statusCode);

    foreach ($this->headers as $key => $value) {
      header($key . ':' . $value);
    }

    switch ($this->contentType) {
      case 'text/html':
        echo $this->content;
        exit;
    }
  }
}
