<?php

namespace Concat\SQLite;

class JoinClause extends AbstractExpression
{
    public $table;

    private $type;

    private $using;

    private $expressions = [];

    public function __construct($type, TableOrSubquery $table)
    {
        $this->table = $table;
        $this->type = $type;
    }

    public function on(...$expressions)
    {
        if ($this->isNatural()) {
            throw new SQLiteException("A natural join can't have ON");
        }
        $this->using = false;
        $this->expressions = $expressions;
    }

    public function using(...$columns)
    {
        if ($this->isNatural()) {
            throw new SQLiteException("A natural join can't have USING");
        }
        $this->using = true;
        $this->columns = $columns;
    }

    private function isNatural()
    {
        return strpos($this->type, "NATURAL") !== false;
    }

    public function __toString()
    {
        $query = "$this->type JOIN $this->table";

        if (!$this->isNatural()) {
            if ($this->using) {
                $query .= " USING (".join(",", $this->columns).")";
            } else {
                $query .= " ON ".join(" AND ", $this->expressions);
            }
        }

        return $query;
    }
}
