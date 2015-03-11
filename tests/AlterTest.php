<?php

namespace Concat\SQLite\Tests;

use Concat\SQLite\Alter;

class AlterTest extends \PHPUnit_Framework_TestCase
{
    use StatementTest;

    protected static $key = "alter";

    /////////////////

    public function test_rename()
    {
        $this->sql(
            Alter::table("A")->renameTo("Z"),
            Alter::table("A")->rename("Z")

        );
    }

    public function test_add()
    {
        $this->sql(
            Alter::table("A")->add("z"),
            Alter::table("A")->addColumn("z")
        );
    }
}
