<?php

namespace Concat\SQLite\Traits;

trait Temporary
{
    private $temporary = false;

    public function temporary($temporary = true)
    {
        $this->temporary = $temporary;

        return $this;
    }

    public function buildTemporary()
    {
        if ($this->temporary) {
            return "TEMPORARY";
        }
    }
}
