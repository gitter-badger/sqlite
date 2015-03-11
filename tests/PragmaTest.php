<?php

namespace Concat\SQLite\Tests;

use Concat\SQLite\Pragma;

class PragmaTest extends \PHPUnit_Framework_TestCase
{
    use StatementTest;

    protected static $key = "pragma";

    /////////////////

    public function test_pragma()
    {
        $this->sql(
            Pragma::set("x", "y")
        );
    }

    public function test_pragma_key_only()
    {
        $this->sql(
            Pragma::set("x")
        );
    }
}
