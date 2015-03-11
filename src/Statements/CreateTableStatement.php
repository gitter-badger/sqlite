<?php

namespace Concat\SQLite;

class CreateTableStatement extends AbstractExpression
{
    use Traits\Temporary;

    private $name;

  //  private $skipExistsCheck = false;

    private $select;

    private $withoutRowId;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function withoutRowId($withoutRowId = true)
    {
        $this->withoutRowId = $withoutRowId;

        return $this;
    }

    // public function skipExistsCheck($skipExistsCheck = true){
    //     $this->skipExistsCheck = $skipExistsCheck;
    //     return $this;
    // }

    public function columns(...$columns)
    {
        $columns = $this->flatten($columns);

        foreach ($columns as &$column) {
            $column = new ColumnDefinition($column);
        }

        // merge or overwrite here?
        $this->columns = $columns;

        return $this;
    }

    public function using(SelectStatement $select)
    {
        $this->select = $select;

        return $this;
    }

    public function __toString()
    {
        $temporary = $this->buildTemporary();

        $query = "CREATE";

        if ($temporary) {
            $query .= " $temporary";
        }

        $query .= " TABLE IF NOT EXISTS $this->name ";

        if ($this->select) {
            $query .= "AS $this->select";
        } else {
            $query .= "(".join(",", $this->columns).")";

            if ($this->withoutRowId) {
                $query .= " WITHOUT ROWID";
            }
        }

        return $query;
    }
}
