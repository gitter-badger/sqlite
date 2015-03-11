<?php

namespace Concat\SQLite;

class Replace extends Insert
{

    public static function into($into)
    {
        return (self::orReplace())->into($into);
    }

}
