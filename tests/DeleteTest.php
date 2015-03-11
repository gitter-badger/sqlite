<?php

namespace Concat\SQLite\Tests;

use Concat\SQLite\Delete;

class DeleteTest extends \PHPUnit_Framework_TestCase
{
    use StatementTest;

    protected static $key = "delete";

    /////////////////

    // table

    public function test_delete()
    {
        $this->sql(
            Delete::from('A')
        );
    }

    public function test_delete_where()
    {
        $this->sql(
            Delete::from('A')->where("a", ">", 0)
        );
    }
}
