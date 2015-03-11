<?php

namespace Concat\SQLite;

class Column
{
    const INT_VALUE   = "INTEGER";
    const INT_PRIMARY = "INTEGER PRIMARY KEY";
    const AUTO_INC    = "INTEGER PRIMARY KEY AUTOINCREMENT";
    const DECIMAL     = "REAL";
    const TEXT        = "TEXT";

    private $name, $type, $unique = false, $initial, $indexed = false;

    public function __construct($name, $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    public function unique()
    {
        $this->unique = true;

        return $this;
    }

    public function index()
    {
        $this->indexed = true;

        return $this;
    }

    public function indexed()
    {
        return !!$this->indexed;
    }

    public function isUnique()
    {
        return !!$this->unique;
    }

    public function name()
    {
        return $this->name;
    }

    public function type()
    {
        return $this->type;
    }

    public function initial($initial = null)
    {
        if ($initial === null) {
            if (is_callable($this->initial)) {
                return $this->initial();
            } else {
                return $this->initial;
            }
        } else {
            $this->initial = $initial;

            return $this;
        }
    }
}
