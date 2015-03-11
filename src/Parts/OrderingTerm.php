<?php

namespace Concat\SQLite;

class OrderingTerm extends AbstractExpression
{
    private $expression;
    private $collate;
    private $ascending;

    public function __construct($expression, $collate = "", $ascending = null)
    {
        $this->expression = $expression;
        $this->ascending = $ascending;
        $this->collate = $collate;
    }

    public function ascending($ascending = true)
    {
        $this->ascending = $ascending;
    }

    public function collate($collate)
    {
        $this->collate = $collate;
    }

    public function __toString()
    {
        $query = $this->expression;

        if ($this->collate) {
            $query .= " COLLATE $this->collate";
        }

        if ($this->ascending !== null) {
            $query .= $this->ascending ? " ASC" : " DESC";
        }

        return $query;
    }
}
