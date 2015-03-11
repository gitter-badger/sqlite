<?php

namespace Concat\SQLite;

class Update
{
    public static function table($table)
    {
        return (new UpdateStatement())->table($table);
    }

    public static function orReplace()
    {
        return (new UpdateStatement())->onConflict("REPLACE");
    }

    public static function orRollback()
    {
        return (new UpdateStatement())->onConflict("ROLLBACK");
    }

    public static function orAbort()
    {
        return (new UpdateStatement())->onConflict("ABORT");
    }

    public static function orFail()
    {
        return (new UpdateStatement())->onConflict("FAIL");
    }

    public static function orIgnore()
    {
        return (new UpdateStatement())->onConflict("IGNORE");
    }
}
