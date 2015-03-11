<?php

namespace Concat\SQLite;

class CommonTableExpression extends AbstractExpression
{
    private $table;
    private $columns;
    private $select;

    protected function __construct($table, $columns, SelectStatement $select)
    {
        $this->table = $table;
        $this->columns = $columns;
        $this->select = $select;
    }

    public function __toString()
    {
        if ($this->columns) {
            $columns = "(".join(",", $this->columns).")";
        } else {
            $columns = "";
        }

        return "$this->table $columns AS ($this->select)";
    }
}
