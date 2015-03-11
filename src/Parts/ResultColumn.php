<?php

namespace Concat\SQLite;

class ResultColumn extends AbstractExpression
{
    private $from;

    public function __construct($from)
    {
        $this->from = $from;
    }

    public function __toString()
    {
        if (is_a($this->from, AbstractExpression::class)) {
            return "($this->from)";
        }

        return $this->from;
    }
}
