<?php

namespace Concat\SQLite;

class AlterStatement extends AbstractExpression
{
    private $table;

    private $name;

    private $columns;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function rename($name)
    {
        $this->name = $name;

        return $this;
    }

    public function renameTo($name)
    {
        return $this->rename($name);
    }

    public function add($column)
    {
        $this->column = new ColumnDefinition($column);

        return $this;
    }

    public function addColumn($column)
    {
        return $this->add($column);
    }

    public function __toString()
    {
        $query = "ALTER TABLE $this->table ";

        if ($this->name) {
            $query .= "RENAME TO $this->name";
        } else {
            // add column
            $query .= "ADD COLUMN $this->column";
        }

        return $query;
    }
}
