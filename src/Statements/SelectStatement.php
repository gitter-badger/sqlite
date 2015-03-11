<?php

namespace Concat\SQLite;

class SelectStatement extends AbstractExpression
{
    use Traits\Where;

    private $from = [];

    private $columns = [];

    private $join = [];

    private $orderBy = [];

    private $distinct = false;

    private $skipSelect = false;

    private $groupBy = [];

    private $limit;

    private $offset;

    private $having;

    private $compounds = [];

    public function distinct($distinct = true)
    {
        $this->distinct = $distinct;

        return $this;
    }

    public function from(...$from)
    {
        $from = $this->flatten($from);

        foreach ($from as $f) {
            $this->from[] = new TableOrSubquery($f);
        }

        return $this;
    }

    public function only(...$columns)
    {
        $columns = $this->flatten($columns);

        foreach ($columns as $c) {
            $this->columns[] = new ResultColumn($c);
        }

        return $this;
    }

    private function _join($type, $table, $alias)
    {
        $table = new TableOrSubquery($table);
        if ($alias) {
            $table->alias = $alias;
        }
        $this->join[] = new JoinClause($type, $table);

        return $this;
    }

    public function join($table, $alias = false)
    {
        return $this->_join("INNER", $table, $alias);
    }

    public function leftJoin($table, $alias = false)
    {
        return $this->_join("LEFT", $table, $alias);
    }

    public function leftOuterJoin($table, $alias = false)
    {
        return $this->_join("LEFT OUTER", $table, $alias);
    }

    public function naturalJoin($table, $alias = false)
    {
        return $this->_join("NATURAL INNER", $table, $alias);
    }

    public function naturalLeftJoin($table, $alias = false)
    {
        return $this->_join("NATURAL LEFT", $table, $alias);
    }

    public function naturalLeftOuterJoin($table, $alias = false)
    {
        return $this->_join("NATURAL LEFT OUTER", $table, $alias);
    }

    public function using(...$columns)
    {
        $columns = $this->flatten($columns);

        // use this on most recent join
        if (!$this->join) {
            throw new SQLiteException("Can't call using before join");
        }

        $this->join[count($this->join) - 1]->using(...$columns);

        return $this;
    }

    public function on(...$expressions)
    {
        $expressions = $this->flatten($expressions);

        if (!$this->join) {
            throw new SQLiteException("Can't call on before join");
        }

        $this->join[count($this->join) - 1]->on(...$expressions);

        return $this;
    }

    public function onColumns(...$columns)
    {
        $columns = $this->flatten($columns);

        if (!$this->join) {
            throw new SQLiteException("Can't call onColumns before join");
        }

        $from = $this->from[count($this->from) - 1];
        $join = $this->join[count($this->join) - 1];

        foreach ($columns as &$column) {
            $a = $from->getName();
            $b = $join->table->getName();
            $column = "$a.$column = $b.$column";
        }

        $join->on(...$columns);

        return $this;
    }

    public function groupBy(...$expressions)
    {
        $groupBy = [];
        foreach ($this->flatten($expressions) as $e) {
            if (is_a($e, AbstractExpression::class)) {
                $groupBy[] = "($e)";
            } else {
                $groupBy[] = $e;
            }
        }

        $this->groupBy = array_merge($this->groupBy, $groupBy);

        return $this;
    }

    public function having($left, $operator = null, $right = null)
    {
        $count = count($this->having);
        if ($count > 0) {
            $this->having[$count - 1]->setAnd(true);
        }

        $this->having[] = new WhereClause($left, $operator, $right);

        return $this;
    }

    public function orHaving($left, $operator = null, $right = null)
    {
        $count = count($this->having);
        if ($count > 0) {
            $this->having[$count - 1]->setAnd(false);
            $this->having[] = new WhereClause($left, $operator, $right);
        } else {
            throw new SQLiteException("Can't call orHaving before having");
        }

        return $this;
    }

    public function orderBy(...$expressions)
    {
        $orderBy = [];
        foreach ($this->flatten($expressions) as $e) {
            $orderBy[] = new OrderingTerm($e);
        }

        $this->orderBy = array_merge($this->orderBy, $orderBy);

        return $this;
    }

    public function insensitive()
    {
        return $this->nocase();
    }

    public function nocase()
    {
        if (!$this->orderBy) {
            throw new SQLiteException("Can't call nocase before orderBy");
        }

        $orderBy = $this->orderBy[count($this->orderBy) - 1];
        $orderBy->collate("NOCASE");

        return $this;
    }

    public function ascending(...$expressions)
    {
        $this->orderBy(...$expressions);

        $orderBy = $this->orderBy[count($this->orderBy) - 1];
        $orderBy->ascending(true);

        return $this;
    }

    public function descending(...$expressions)
    {
        $this->orderBy(...$expressions);

        $orderBy = $this->orderBy[count($this->orderBy) - 1];
        $orderBy->ascending(false);

        return $this;
    }

    public function desc(...$expressions)
    {
        return $this->descending(...$expressions);
    }

    public function asc(...$expressions)
    {
        return $this->ascending(...$expressions);
    }

    public function limit($limit, $offset = null)
    {
        $this->limit = $limit;
        if ($offset !== null) {
            $this->offset = $offset;
        }

        return $this;
    }

    public function offset($offset)
    {
        $this->offset = $offset;

        return $this;
    }

    private function addCompounds($type, $statements)
    {
        $compounds = [];
        foreach ($this->flatten($statements) as $s) {
            $compounds[] = new CompoundOperator($type, $s);
        }

        $this->compounds = array_merge($this->compounds, $compounds);

        return $this;
    }

    public function union(...$statements)
    {
        return $this->addCompounds("UNION", $statements);
    }

    public function unionAll(...$statements)
    {
        return $this->addCompounds("UNION ALL", $statements);
    }

    public function intersect(...$statements)
    {
        return $this->addCompounds("INTERSECT", $statements);
    }

    public function except(...$statements)
    {
        return $this->addCompounds("EXCEPT", $statements);
    }

    public function __toString()
    {
        $query = "SELECT ";

        if ($this->distinct) {
            $query .= "DISTINCT ";
        }

        if ($this->columns) {
            $query .= join(",", $this->columns);
        } else {
            $query .=  "*";
        }

        if ($this->from) {
            $query .= " FROM ".join(",", $this->from);
        }

        if ($this->join) {
            $query .= " ".join(" ", $this->join);
        }

        $where = $this->buildWhere();

        if ($where) {
            $query .= " $where";
        }

        if ($this->groupBy) {
            $query .= " GROUP BY ".join(",", $this->groupBy);
        }

        if ($this->having) {
            $query .= " HAVING ";
            $query .= join(" ", $this->having);
        }

        if ($this->compounds) {
            $query .= " ".join(" ", $this->compounds);
        }

        if ($this->orderBy) {
            $query .= " ORDER BY ".join(",", $this->orderBy);
        }

        if ($this->limit) {
            $query .= " LIMIT $this->limit";

            if ($this->offset) {
                $query .= " OFFSET $this->offset";
            }
        }

        return $query;
    }
}
