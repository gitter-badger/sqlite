<?php

namespace Concat\SQLite;

class QuerySet
{
    protected $statement;
    private $cache;

    private $store;

    public function __construct(\PDOStatement $statement)
    {
        $this->statement = $statement;
    }

    public function next()
    {
        // get or set the cache and increment pointer
        return $this->cache(true);
    }

    public function unique()
    {
        $this->store = array_unique($this->all());

        return $this;
    }

    public function filter(callable $callable)
    {
        $this->store = array_filter($this->all(), $callable);

        return $this;
    }

    public function each(callable $callable)
    {
        $this->store = array_map($callable, $this->all());

        return $this;
    }

    public function get()
    {
        // get or set the cache without incrementing pointer
        return $this->cache(false);
    }

    private function cache($increment)
    {
        if ($this->cache === null) {
            // cached row does not exist

            // get the next row of the result set
            // this also moves the cursor forward
            $value = $this->statement->fetch();

            if (!$increment) {
                // if we don't want to move the cursor forward,
                // set the cache to be the current row.

                // this is done so that when cache is called again
                // and we don't want to increment the cursor,
                // we can just return the cache instead and not
                // touch the result set.
                $this->cache = $value;
            }
        } else {
            // a cached row exists, so we want to return it
            $value = $this->cache;

            if ($increment) {
                // if we want to increment the result set cursor,
                // we also push the next row onto the cache
                $this->cache = $this->statement->fetch();
            }
        }

        return $value;
    }

    public function all()
    {
        // this function assumed that either the
        // default fetch mode is appropriate or the
        // fetch mode of the statement has been changed.

        if (!$this->store) {
            $this->store = $this->statement->fetchAll();
        }

        return $this->store;
    }

    public function statement()
    {
        return $this->statement;
    }
}
