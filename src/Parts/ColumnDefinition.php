<?php

namespace Concat\SQLite;

class ColumnDefinition extends AbstractExpression
{
    private $definition;

    public function __construct($definition)
    {
        $this->definition = $definition;
    }

    public function __toString()
    {
        return $this->definition;
    }
}
