<?php

namespace Concat\SQLite;

class DeleteStatement extends AbstractExpression
{
    use Traits\Where;

    private $table;

    public function from($table)
    {
        $this->table = $table;

        return $this;
    }

    public function __toString()
    {
        $query = "DELETE FROM $this->table";

        $where = $this->buildWhere();

        if ($where) {
            $query .= " $where";
        }

        return $query;
    }
}
