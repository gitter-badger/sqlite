<?php

namespace Concat\SQLite;

class Insert
{
    public static function into($into)
    {
        return (new InsertStatement())->into($into);
    }

    public static function orReplace()
    {
        return (new InsertStatement())->onConflict("REPLACE");
    }

    public static function orRollback()
    {
        return (new InsertStatement())->onConflict("ROLLBACK");
    }

    public static function orAbort()
    {
        return (new InsertStatement())->onConflict("ABORT");
    }

    public static function orFail()
    {
        return (new InsertStatement())->onConflict("FAIL");
    }

    public static function orIgnore()
    {
        return (new InsertStatement())->onConflict("IGNORE");
    }
}
