<?php

namespace Concat\SQLite;

abstract class AbstractDropStatement extends AbstractExpression
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    abstract protected function getType();

    public function __toString()
    {
        $type = $this->getType();

        return "DROP $type IF EXISTS $this->name";
    }
}
