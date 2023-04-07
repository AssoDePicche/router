<?php

declare(strict_types=1);

namespace Http;

final readonly class Request
{
    public function __construct(
        public array $request,
        public array $query,
        public array $cookies,
        public array $files,
        public array $server
    ) {
    }

    public function getURI(): string
    {
        return $this->server['REQUEST_URI'] ?? '';
    }

    public function getMethod(): string
    {
        return $this->server['REQUEST_METHOD'] ?? '';
    }

    public static function createFromGlobals(): static
    {
        return new static(
            $_POST,
            $_GET,
            $_COOKIE,
            $_FILES,
            $_SERVER
        );
    }
}
