<?php

namespace Concat\SQLite\Tests;

use Concat\SQLite\Drop;

class DropTest extends \PHPUnit_Framework_TestCase
{
    use StatementTest;

    protected static $key = "drop";

    /////////////////

    public function test_drop_table()
    {
        $this->sql(
            Drop::table("A")
        );
    }

    public function test_drop_view()
    {
        $this->sql(
            Drop::view("X")
        );
    }

    public function test_drop_trigger()
    {
        $this->sql(
            Drop::trigger("A")
        );
    }

    public function test_drop_index()
    {
        $this->sql(
            Drop::index("A")
        );
    }
}
