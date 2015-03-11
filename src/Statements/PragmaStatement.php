<?php

namespace Concat\SQLite;

class PragmaStatement extends AbstractExpression
{
    private $key;
    private $value;

    public function __construct($key, $value = null)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function __toString()
    {
        if ($this->value === null) {
            return "PRAGMA $this->key";
        }

        return "PRAGMA $this->key = $this->value";
    }
}
