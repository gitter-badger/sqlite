<?php

namespace Concat\SQLite;

class Delete
{
    public static function from($table)
    {
        return (new DeleteStatement())->from($table);
    }
}
