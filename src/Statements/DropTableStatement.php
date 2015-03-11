<?php

namespace Concat\SQLite;

class DropTableStatement extends AbstractDropStatement
{
    protected function getType()
    {
        return "TABLE";
    }
}
