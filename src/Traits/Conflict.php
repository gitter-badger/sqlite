<?php

namespace Concat\SQLite\Traits;

trait Conflict
{
    protected $onConflict = false;

    public function onConflict($onConflict)
    {
        $this->onConflict = $onConflict;

        return $this;
    }

    public function buildConflict()
    {
        if ($this->onConflict) {
            return "OR $this->onConflict";
        }
    }
}
