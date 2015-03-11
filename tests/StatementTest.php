<?php

namespace Concat\SQLite\Tests;

trait StatementTest
{
    private static $queries;

    private static $tables = ["A", "B", "C"];

    private static $columns = ["a", "b", "c"];

    private static $db;

    /**
     * @codeCoverageIgnore
     */
    public static function setUpBeforeClass()
    {
        $q = require __DIR__."/Queries.php";
        self::$queries = $q[self::$key];
    }

    public function setUp()
    {
        self::$db = new \PDO("sqlite::memory:");

        foreach (self::$tables as $table) {
            self::$db->query("CREATE TABLE IF NOT EXISTS $table (".join(",", self::$columns).")");

            for ($i = 1; $i < 4; $i++) {
                $values = [];
                foreach (self::$columns as $column) {
                    $values[] = "'{$table}{$column}{$i}'";
                }
                self::$db->query("INSERT INTO $table VALUES (".join(",", $values).")");
            }
        }

        self::$db->query("CREATE VIEW X AS SELECT * FROM ".self::$tables[0]);
    }

    public function tearDown()
    {
        self::$db = null;
    }

    private function sql(...$actual)
    {
        $test = debug_backtrace()[1]['function'];
        $test = substr($test, 5);
        $expected = self::$queries[$test];

        $query = self::$db->query($expected);

        $errors = self::$db->errorInfo();
        $this->assertEquals(null, $errors[2], $errors[2]);

        foreach ($actual as $a) {
            $this->assertEquals($expected, (string) $a);
        }
    }
}
