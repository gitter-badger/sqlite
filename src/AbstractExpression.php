<?php

namespace Concat\SQLite;

abstract class AbstractExpression
{
    abstract public function __toString();

    protected function flatten(array $values)
    {
        $a = [];
        array_walk_recursive($values, function ($x) use (&$a) {
            $a[] = $x;
        });

        return $a;
    }

    protected function quote($value)
    {
        if (is_string($value) && $value[0] !== ':' && $value !== "?") {
            return "'".\Sqlite3::escapeString($value)."'";
        }

        return $value;
    }
}
