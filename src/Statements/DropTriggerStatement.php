<?php

namespace Concat\SQLite;

class DropTriggerStatement extends AbstractDropStatement
{
    protected function getType()
    {
        return "TRIGGER";
    }
}
