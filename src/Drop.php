<?php

namespace Concat\SQLite;

class Drop
{
    public static function table($name)
    {
        return new DropTableStatement($name);
    }

    public static function index($name)
    {
        return new DropIndexStatement($name);
    }

    public static function trigger($name)
    {
        return new DropTriggerStatement($name);
    }

    public static function view($name)
    {
        return new DropViewStatement($name);
    }
}
