<?php

namespace Concat\SQLite\Traits;

use Concat\SQLite\WhereClause;
use Concat\SQLite\SQLiteException;

trait Where
{
    protected $where = [];

    public function where($left, $operator = null, $right = null)
    {
        $count = count($this->where);
        if ($count > 0) {
            $this->where[$count - 1]->setAnd(true);
        }

        $this->where[] = new WhereClause($left, $operator, $right);

        return $this;
    }

    public function orWhere($left, $operator = null, $right = null)
    {
        $count = count($this->where);
        if ($count > 0) {
            $this->where[$count - 1]->setAnd(false);
            $this->where[] = new WhereClause($left, $operator, $right);
        } else {
            throw new SQLiteException("Can't call orWhere before where");
        }

        return $this;
    }

    public function buildWhere()
    {
        if ($this->where) {
            return $this->getWherePrefix()." ".join(" ", $this->where);
        }
    }

    public function when($left, $operator = null, $right = null)
    {
        return $this->where($left, $operator, $right);
    }

    public function orWhen($left, $operator = null, $right = null)
    {
        return $this->orWhere($left, $operator, $right);
    }

    public function buildWhen()
    {
        return $this->buildWhere();
    }

    public function getWherePrefix()
    {
        return "WHERE";
    }
}
