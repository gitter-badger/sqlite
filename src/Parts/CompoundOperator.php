<?php

namespace Concat\SQLite;

class CompoundOperator extends AbstractExpression
{
    private $type;

    private $statement;

    public function __construct($type, AbstractExpression $statement)
    {
        $this->type = $type;
        $this->statement = $statement;
    }

    public function __toString()
    {
        return "$this->type $this->statement";
    }
}
