<?php

declare(strict_types=1);

namespace Http\Enum;

enum StatusCode: int
{
    public const OK = 200;

    public const NOT_FOUND = 404;

    public const METHOD_NOT_ALLOWED = 405;

    public const INTERNAL_SERVER_ERROR = 500;
}
