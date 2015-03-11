<?php

namespace Concat\SQLite;

class Create
{
    public static function table($name)
    {
        return new CreateTableStatement($name);
    }

    public static function index($name)
    {
        return new CreateIndexStatement($name);
    }

    public static function trigger($name)
    {
        return new CreateTriggerStatement($name);
    }

    public static function view($name)
    {
        return new CreateViewStatement($name);
    }
}
