<?php

namespace Concat\SQLite;

class Pragma
{
    public static function set($key, $value = null)
    {
        return new PragmaStatement($key, $value);
    }
}
