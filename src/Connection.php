<?php

namespace Concat\SQLite;

class Connection
{
    private $connection;

    private $query_count = 0;

    public function __construct($path)
    {
        $connection = new \PDO("sqlite:$path");

        $connection->query("PRAGMA foreign_keys = ON");
        $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

        $this->connection = $connection;
    }

    private function bind($statement, $values)
    {
        foreach ($values as $param => $value) {
            if (is_string($param)) {
                $param = ":$param";
            }
            $statement->bindValue($param, $value);
        }

        return $statement;
    }

    public function beginTransaction()
    {
        return $this->connection->beginTransaction();
    }

    public function inTransaction()
    {
        return $this->connection->inTransaction();
    }

    public function commit($commit = true)
    {
        if ($commit) {
            return $this->connection->commit();
        }

        return $this->beginTransaction();
    }

    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }

    public function execute($query, $values = [])
    {
        $statement = $this->connection->prepare($query);

        if ($values) {
            $statement = $this->bind($statement, $values);
        }

        $statement->execute();
        $this->$query_count++;

        return $statement;
    }

    public function getQueryCount()
    {
        return $this->$query_count;
    }
}
