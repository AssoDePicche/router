<?php

declare(strict_types=1);

namespace Http\Enum;

enum ContentType: string
{
    public const JSON = 'application/json';

    public const HTML = 'text/html';
}
