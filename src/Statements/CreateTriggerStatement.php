<?php

namespace Concat\SQLite;

class CreateTriggerStatement extends AbstractExpression
{
    use Traits\Where;
    use Traits\Temporary;

    private $name;

    private $table;

    private $columns = [];

    private $statements = [];

    private $stage;

    private $action;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function on($table)
    {
        $this->table = $table;

        return $this;
    }

    public function delete()
    {
        $this->action = "DELETE";

        return $this;
    }

    public function beforeDelete()
    {
        $this->stage = "BEFORE";
        $this->action = "DELETE";

        return $this;
    }

    public function afterDelete()
    {
        $this->stage = "AFTER";
        $this->action = "DELETE";

        return $this;
    }

    public function insteadOfDelete()
    {
        $this->stage = "INSTEAD OF";
        $this->action = "DELETE";

        return $this;
    }

    public function insert()
    {
        $this->action = "INSERT";

        return $this;
    }

    public function afterInsert()
    {
        $this->stage = "AFTER";
        $this->action = "INSERT";

        return $this;
    }

    public function beforeInsert()
    {
        $this->stage = "BEFORE";
        $this->action = "INSERT";

        return $this;
    }

    public function insteadOfInsert()
    {
        $this->stage = "INSTEAD OF";
        $this->action = "INSERT";

        return $this;
    }

    public function update(...$columns)
    {
        $this->action = "UPDATE";
        $this->columns = $this->flatten($columns);

        return $this;
    }

    public function afterUpdate(...$columns)
    {
        $this->stage = "AFTER";
        $this->action = "UPDATE";
        $this->columns = $this->flatten($columns);

        return $this;
    }

    public function beforeUpdate(...$columns)
    {
        $this->stage = "BEFORE";
        $this->action = "UPDATE";
        $this->columns = $this->flatten($columns);

        return $this;
    }

    public function insteadOfUpdate(...$columns)
    {
        $this->stage = "INSTEAD OF";
        $this->action = "UPDATE";
        $this->columns = $this->flatten($columns);

        return $this;
    }

    public function of(...$columns)
    {
        $this->columns = $this->flatten($columns);

        return $this;
    }

    public function getWherePrefix()
    {
        return "WHEN";
    }

    public function run(...$statements)
    {
        $statements = $this->flatten($statements);

        $this->statements = $statements;

        return $this;
    }

    public function __toString()
    {
        $temporary = $this->buildTemporary();

        $query = "CREATE";

        if ($temporary) {
            $query .= " $temporary";
        }

        $query .= " TRIGGER IF NOT EXISTS $this->name ";

        if ($this->stage) {
            $query .= "$this->stage ";
        }

        $query .= $this->action;

        if ($this->action === "UPDATE" && $this->columns) {
            $query .= " OF ".join(",", $this->columns);
        }

        $query .= " ON $this->table";

        $when = $this->buildWhen();
        if ($when) {
            $query .= " $when";
        }

        $query .= " BEGIN ";
        $query .= join(";", $this->statements).";";
        $query .= " END";

        return $query;
    }
}
