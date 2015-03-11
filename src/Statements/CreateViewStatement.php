<?php

namespace Concat\SQLite;

class CreateViewStatement extends AbstractExpression
{
    use Traits\Temporary;

    private $name;

    private $statement;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function using($statement)
    {
        $this->statement = $statement;

        return $this;
    }

    public function __toString()
    {
        $temporary = $this->buildTemporary();

        $query = "CREATE";

        if ($temporary) {
            $query .= " $temporary";
        }

        $query .= " VIEW IF NOT EXISTS $this->name AS $this->statement";

        return $query;
    }
}
