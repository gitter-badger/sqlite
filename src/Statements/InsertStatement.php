<?php

namespace Concat\SQLite;

class InsertStatement extends AbstractExpression
{
    use Traits\Conflict;

    private $values = [];

    private $into;

    private $columns = [];

    private $select;

    public function into($into)
    {
        $this->into = $into;

        return $this;
    }

    public function values(...$values)
    {
        $values = $this->flatten($values);

        if (count($values) === 1 && is_a($values[0], SelectStatement::class)) {
            $this->select = $values[0];
        } else {
            $this->values = array_merge($this->values, $values);
        }

        return $this;
    }

    public function columns(...$columns)
    {
        $columns = $this->flatten($columns);

        $this->columns = array_merge($this->columns, $columns);

        return $this;
    }

    public function __toString()
    {
        $conflict = $this->buildConflict();

        $query = "INSERT";

        if ($conflict) {
            $query .= " $conflict";
        }

        $query .= " INTO $this->into ";

        if ($this->columns) {
            $query .= "(".join(",", $this->columns).") ";
        }

        if ($this->select) {
            $query .= $this->select;
        } else {
            if (empty($this->values)) {
                $values = [];

                // no values, no select, so prepared
                foreach ($this->columns as $column) {
                    // should this be ?
                    $values[] = ":$column";
                }
            } else {
                $values = array_map([$this, 'quote'], $this->values);
            }

            $query .= "VALUES "."(".join(",", $values).")";
        }

        return $query;
    }
}
