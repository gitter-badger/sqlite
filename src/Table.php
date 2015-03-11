<?php

namespace Concat\SQLite;

class Table
{
    private $name;
    private $columns = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function addColumn(Column $column)
    {
        $this->columns[] = $column;
    }

    public function getColumns()
    {
        return $this->columns;
    }
}
