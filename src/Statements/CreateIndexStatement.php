<?php

namespace Concat\SQLite;

class CreateIndexStatement extends AbstractExpression
{
    use Traits\Where;

    private $name;

    private $unique = false;

    private $table;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function unique($unique = true)
    {
        $this->unique = $unique;

        return $this;
    }

    public function on($table)
    {
        $this->table = $table;

        return $this;
    }

    public function columns(...$columns)
    {
        $this->columns = $this->flatten($columns);

        return $this;
    }

    public function __toString()
    {
        $query = "CREATE ";

        if ($this->unique) {
            $query .= "UNIQUE ";
        }

        $query .= "INDEX IF NOT EXISTS $this->name ON $this->table ";
        $query .= "(".join(",", $this->columns).")";

        $where = $this->buildWhere();
        if ($where) {
            $query .= " $where";
        }

        return $query;
    }
}
