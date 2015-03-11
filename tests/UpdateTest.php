<?php

namespace Concat\SQLite\Tests;

use Concat\SQLite\Update;

class UpdateTest extends \PHPUnit_Framework_TestCase
{
    use StatementTest;

    protected static $key = "update";

    /////////////////

    // table

    public function test_update()
    {
        $this->sql(
            Update::table("A")->set("a", "a"),
            Update::table("A")->set(["a" => "a"])
        );
    }

    public function test_update_many()
    {
        $this->sql(
            Update::table("A")->set(["a" => "a", "b" => "b"])
        );
    }

    public function test_update_where()
    {
        $this->sql(
            Update::table("A")->set("a", "a")->where("c", '=', 0)
        );
    }

    public function test_update_many_where()
    {
        $this->sql(
            Update::table("A")->set(["a" => "a", "b" => "b"])->where("c", '=', 0)
        );
    }

    //

    public function test_prepared_update()
    {
        $this->sql(
            Update::table("A")->set("a", ":a"),
            Update::table("A")->set(["a" => ":a"])
        );
    }

    public function test_prepared_update_many()
    {
        $this->sql(
            Update::table("A")->set(["a" => ":a", "b" => ":b"])
        );
    }

    public function test_prepared_update_where()
    {
        $this->sql(
            Update::table("A")->set("a", ":a")->where("c", '=', ':c')
        );
    }

    public function test_prepared_update_many_where()
    {
        $this->sql(
            Update::table("A")->set(["a" => ":a", "b" => ":b"])->where("c", '=', ':c')
        );
    }

    //

    public function test_update_or_replace()
    {
        $this->sql(
            Update::orReplace()->table("A")->set("a", "a")
        );
    }

    public function test_update_or_abort()
    {
        $this->sql(
            Update::orAbort()->table("A")->set("a", "a")
        );
    }

    public function test_update_or_ignore()
    {
        $this->sql(
            Update::orIgnore()->table("A")->set("a", "a")
        );
    }

    public function test_update_or_fail()
    {
        $this->sql(
            Update::orFail()->table("A")->set("a", "a")
        );
    }

    public function test_update_or_rollback()
    {
        $this->sql(
            Update::orRollback()->table("A")->set("a", "a")
        );
    }
}
