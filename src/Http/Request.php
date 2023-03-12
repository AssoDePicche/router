<?php

declare(strict_types=1);

namespace Http;

final readonly class Request
{
    public string $method, $uri;

    public array $headers, $params, $vars;

    public function __construct()
    {
        $this->headers = getallheaders();

        $this->params = $_GET ?? [];

        $this->vars = $_POST ?? [];

        $this->method = $_SERVER['REQUEST_METHOD'] ?? '';

        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
    }
}
