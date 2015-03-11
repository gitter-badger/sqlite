<?php

namespace Concat\SQLite;

class UpdateStatement extends AbstractExpression
{
    use Traits\Where;
    use Traits\Conflict;

    private $table;

    private $values = [];

    public function table($table)
    {
        $this->table = $table;

        return $this;
    }

    public function set($column, $value = null)
    {
        if (is_array($column)) {
            // assume key value pairs
            $this->values = array_merge($this->values, $column);
        } else {
            $this->values[$column] = $value;
        }

        return $this;
    }

    public function __toString()
    {
        $conflict = $this->buildConflict();

        $query = "UPDATE";

        if ($conflict) {
            $query .= " $conflict";
        }

        $query .= " $this->table SET ";

        $values = [];
        foreach ($this->values as $column => $value) {
            $values[] = "$column = ".$this->quote($value);
        }
        $query .= join(",", $values);

        $where = $this->buildWhere();

        if ($where) {
            $query .= " $where";
        }

        return $query;
    }
}
