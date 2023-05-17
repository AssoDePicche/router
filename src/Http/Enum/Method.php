<?php

declare(strict_types=1);

namespace Http\Enum;

enum Method: string
{
    public const DELETE = 'DELETE';

    public const GET = 'GET';

    public const PATCH = 'PATCH';

    public const POST = 'POST';

    public const PUT = 'PUT';
}
