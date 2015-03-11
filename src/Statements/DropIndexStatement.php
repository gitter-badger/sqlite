<?php

namespace Concat\SQLite;

class DropIndexStatement extends AbstractDropStatement
{
    protected function getType()
    {
        return "INDEX";
    }
}
