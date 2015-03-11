<?php

namespace Concat\SQLite;

class TableOrSubquery extends AbstractExpression
{
    private $from;

    public $alias;

    public function __construct($from)
    {
        $this->from = $from;

        preg_match("/\s+as\s+([\w\.]*)$/i", $from, $parts);

        if ($parts) {
            $this->alias = array_pop($parts);
            $this->from = preg_replace("/\s+as\s+([\w\.]*)$/i", "", $from);
        }
    }

    public function getName()
    {
        if ($this->alias !== null) {
            return $this->alias;
        }

        return $this->from;
    }

    public function __toString()
    {
        if (is_a($this->from, AbstractExpression::class)) {
            $query = "($this->from)";
        } else {
            $query = $this->from;
        }

        if ($this->alias) {
            $query .= " AS $this->alias";
        }

        return $query;
    }
}
