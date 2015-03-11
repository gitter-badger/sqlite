<?php

namespace Concat\SQLite\Tests;

use Concat\SQLite\Insert;
use Concat\SQLite\Select;

class InsertTest extends \PHPUnit_Framework_TestCase
{
    use StatementTest;

    protected static $key = "insert";

    /////////////////

    public function test_insert_values()
    {
        $this->sql(
            Insert::into("A")->columns("a", "b", "c")->values("x", "y", "z"),
            Insert::into("A")->columns(["a", "b", "c"])->values(["x", "y", "z"])
        );
    }

    public function test_insert_select()
    {
        $this->sql(
            Insert::into("A")->columns("a", "b", "c")->values(Select::from("B"))
        );
    }

    public function test_insert_all()
    {
        $this->sql(
            Insert::into("A")->values("x", "y", "z"),
            Insert::into("A")->values(["x", "y", "z"])
        );
    }

    /// conflicts

    public function test_insert_or_replace()
    {
        $this->sql(
            Insert::orReplace()->into("A")->columns("a", "b", "c")->values("x", "y", "z")
        );
    }

    public function test_insert_or_rollback()
    {
        $this->sql(
            Insert::orRollback()->into("A")->columns("a", "b", "c")->values("x", "y", "z")
        );
    }

    public function test_insert_or_abort()
    {
        $this->sql(
            Insert::orAbort()->into("A")->columns("a", "b", "c")->values("x", "y", "z")
        );
    }

    public function test_insert_or_fail()
    {
        $this->sql(
            Insert::orFail()->into("A")->columns("a", "b", "c")->values("x", "y", "z")
        );
    }

    public function test_insert_or_ignore()
    {
        $this->sql(
            Insert::orIgnore()->into("A")->columns("a", "b", "c")->values("x", "y", "z")
        );
    }

    /////////////

    public function test_insert_values_prepared()
    {
        $this->sql(
            Insert::into("A")->columns("a", "b", "c"),
            Insert::into("A")->columns(["a", "b", "c"])
        );
    }
}
