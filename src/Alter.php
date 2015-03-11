<?php

namespace Concat\SQLite;

class Alter
{
    public static function table($table)
    {
        return new AlterStatement($table);
    }
}
