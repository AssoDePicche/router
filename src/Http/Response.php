<?php

declare(strict_types=1);

namespace Http;

use Exception;
use Http\Enum\StatusCode;

final readonly class Response
{
    public function __construct(
        public string $content = '',
        public int $statusCode = StatusCode::OK,
        public array $headers = []
    ) {
    }

    public function send(): void
    {
        http_response_code($this->statusCode);

        foreach ($this->headers as $key => $value) {
            header($key . ':' . $value);
        }

        echo $this->content;
    }

    public static function createFromException(Exception $exception): static
    {
        return new static(
            $exception->getMessage(),
            $exception->getCode()
        );
    }
}
