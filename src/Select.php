<?php

namespace Concat\SQLite;

class Select
{
    public static function from(...$from)
    {
        return (new SelectStatement())->from(...$from);
    }

    public static function only(...$columns)
    {
        return (new SelectStatement())->only(...$columns);
    }
}
