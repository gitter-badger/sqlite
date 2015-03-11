<?php

namespace Concat\SQLite;

class DropViewStatement extends AbstractDropStatement
{
    protected function getType()
    {
        return "VIEW";
    }
}
