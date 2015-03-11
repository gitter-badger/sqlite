<?php

namespace Concat\SQLite\Tests;

use Concat\SQLite\Create;
use Concat\SQLite\Select;

class CreateTest extends \PHPUnit_Framework_TestCase
{
    use StatementTest;

    protected static $key = "create";

    /////////////////

    // table

    public function test_create_table()
    {
        $this->sql(
            Create::table('X')->columns("a", "b"),
            Create::table('X')->columns(["a", "b"])
        );
    }

    public function test_create_table_using()
    {
        $this->sql(
            Create::table('X')->using(Select::from("A"))
        );
    }

    public function test_create_table_without_id()
    {
        $this->sql(
            Create::table('X')->columns("a PRIMARY KEY", "b")->withoutRowId(),
            Create::table('X')->columns(["a PRIMARY KEY", "b"])->withoutRowId()
        );
    }

    public function test_create_temp_table()
    {
        $this->sql(
            Create::table('X')->columns("a", "b")->temporary(),
            Create::table('X')->columns(["a", "b"])->temporary()
        );
    }

    public function test_create_temp_table_using()
    {
        $this->sql(
            Create::table('X')->using(Select::from("A"))->temporary()
        );
    }

    public function test_create_temp_table_without_id()
    {
        $this->sql(
            Create::table('X')->columns("a PRIMARY KEY", "b")->withoutRowId()->temporary(),
            Create::table('X')->columns(["a PRIMARY KEY", "b"])->withoutRowId()->temporary()
        );
    }

    // trigger

    //delete

    public function test_create_trigger_delete()
    {
        $this->sql(
            Create::trigger('X')->delete()->on('A')->run(
                Select::from('A')
            )
        );
    }

    public function test_create_trigger_before_delete()
    {
        $this->sql(
            Create::trigger('X')->beforeDelete()->on('A')->run(
                Select::from('A')
            )
        );
    }

    public function test_create_trigger_after_delete()
    {
        $this->sql(
            Create::trigger('X')->afterDelete()->on('A')->run(
                Select::from('A')
            )
        );
    }

    public function test_create_trigger_insteadof_delete()
    {
        $this->sql(
            Create::trigger('T')->insteadOfDelete()->on('X')->run(
                Select::from('A')
            )
        );
    }

    public function test_create_trigger_delete_when()
    {
        $this->sql(
            Create::trigger('X')->delete()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)
        );
    }

    public function test_create_trigger_before_delete_when()
    {
        $this->sql(
            Create::trigger('X')->beforeDelete()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)
        );
    }

    public function test_create_trigger_after_delete_when()
    {
        $this->sql(
            Create::trigger('X')->afterDelete()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)
        );
    }

    public function test_create_trigger_insteadof_delete_when()
    {
        $this->sql(
            Create::trigger('T')->insteadOfDelete()->on('X')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)
        );
    }

    //

    public function test_create_temp_trigger_delete()
    {
        $this->sql(
            Create::trigger('X')->delete()->on('A')->run(
                Select::from('A')
            )->temporary()
        );
    }

    public function test_create_temp_trigger_before_delete()
    {
        $this->sql(
            Create::trigger('X')->beforeDelete()->on('A')->run(
                Select::from('A')
            )->temporary()
        );
    }

    public function test_create_temp_trigger_after_delete()
    {
        $this->sql(
            Create::trigger('X')->afterDelete()->on('A')->run(
                Select::from('A')
            )->temporary()
        );
    }

    public function test_create_temp_trigger_insteadof_delete()
    {
        $this->sql(
            Create::trigger('T')->insteadOfDelete()->on('X')->run(
                Select::from('A')
            )->temporary()
        );
    }

    public function test_create_temp_trigger_delete_when()
    {
        $this->sql(
            Create::trigger('X')->delete()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->temporary()
        );
    }

    public function test_create_temp_trigger_before_delete_when()
    {
        $this->sql(
            Create::trigger('X')->beforeDelete()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->temporary()
        );
    }

    public function test_create_temp_trigger_after_delete_when()
    {
        $this->sql(
            Create::trigger('X')->afterDelete()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->temporary()
        );
    }

    public function test_create_temp_trigger_insteadof_delete_when()
    {
        $this->sql(
            Create::trigger('T')->insteadOfDelete()->on('X')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->temporary()
        );
    }

    // insert

    public function test_create_trigger_insert()
    {
        $this->sql(
            Create::trigger('X')->insert()->on('A')->run(
                Select::from('A')
            )
        );
    }

    public function test_create_trigger_before_insert()
    {
        $this->sql(
            Create::trigger('X')->beforeInsert()->on('A')->run(
                Select::from('A')
            )
        );
    }

    public function test_create_trigger_after_insert()
    {
        $this->sql(
            Create::trigger('X')->afterInsert()->on('A')->run(
                Select::from('A')
            )
        );
    }

    public function test_create_trigger_insteadof_insert()
    {
        $this->sql(
            Create::trigger('T')->insteadOfInsert()->on('X')->run(
                Select::from('A')
            )
        );
    }

    public function test_create_trigger_insert_when()
    {
        $this->sql(
            Create::trigger('X')->insert()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)
        );
    }

    public function test_create_trigger_before_insert_when()
    {
        $this->sql(
            Create::trigger('X')->beforeInsert()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)
        );
    }

    public function test_create_trigger_after_insert_when()
    {
        $this->sql(
            Create::trigger('X')->afterInsert()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)
        );
    }

    public function test_create_trigger_insteadof_insert_when()
    {
        $this->sql(
            Create::trigger('T')->insteadOfInsert()->on('X')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)
        );
    }

    //

    public function test_create_temp_trigger_insert()
    {
        $this->sql(
            Create::trigger('X')->insert()->on('A')->run(
                Select::from('A')
            )->temporary()
        );
    }

    public function test_create_temp_trigger_before_insert()
    {
        $this->sql(
            Create::trigger('X')->beforeInsert()->on('A')->run(
                Select::from('A')
            )->temporary()
        );
    }

    public function test_create_temp_trigger_after_insert()
    {
        $this->sql(
            Create::trigger('X')->afterInsert()->on('A')->run(
                Select::from('A')
            )->temporary()
        );
    }

    public function test_create_temp_trigger_insteadof_insert()
    {
        $this->sql(
            Create::trigger('T')->insteadOfInsert()->on('X')->run(
                Select::from('A')
            )->temporary()
        );
    }

    public function test_create_temp_trigger_insert_when()
    {
        $this->sql(
            Create::trigger('X')->insert()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->temporary()
        );
    }

    public function test_create_temp_trigger_before_insert_when()
    {
        $this->sql(
            Create::trigger('X')->beforeInsert()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->temporary()
        );
    }

    public function test_create_temp_trigger_after_insert_when()
    {
        $this->sql(
            Create::trigger('X')->afterInsert()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->temporary()
        );
    }

    public function test_create_temp_trigger_insteadof_insert_when()
    {
        $this->sql(
            Create::trigger('T')->insteadOfInsert()->on('X')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->temporary()
        );
    }

    // update

    public function test_create_trigger_update()
    {
        $this->sql(
            Create::trigger('X')->update()->on('A')->run(
                Select::from('A')
            )
        );
    }

    public function test_create_trigger_before_update()
    {
        $this->sql(
            Create::trigger('X')->beforeUpdate()->on('A')->run(
                Select::from('A')
            )
        );
    }

    public function test_create_trigger_after_update()
    {
        $this->sql(
            Create::trigger('X')->afterUpdate()->on('A')->run(
                Select::from('A')
            )
        );
    }

    public function test_create_trigger_insteadof_update()
    {
        $this->sql(
            Create::trigger('T')->insteadOfUpdate()->on('X')->run(
                Select::from('A')
            )
        );
    }

    public function test_create_trigger_update_when()
    {
        $this->sql(
            Create::trigger('X')->update()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)
        );
    }

    public function test_create_trigger_before_update_when()
    {
        $this->sql(
            Create::trigger('X')->beforeUpdate()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)
        );
    }

    public function test_create_trigger_after_update_when()
    {
        $this->sql(
            Create::trigger('X')->afterUpdate()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)
        );
    }

    public function test_create_trigger_insteadof_update_when()
    {
        $this->sql(
            Create::trigger('T')->insteadOfUpdate()->on('X')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)
        );
    }

    //

     public function test_create_temp_trigger_update()
     {
         $this->sql(
            Create::trigger('X')->update()->on('A')->run(
                Select::from('A')
            )->temporary()
        );
     }

    public function test_create_temp_trigger_before_update()
    {
        $this->sql(
            Create::trigger('X')->beforeUpdate()->on('A')->run(
                Select::from('A')
            )->temporary()
        );
    }

    public function test_create_temp_trigger_after_update()
    {
        $this->sql(
            Create::trigger('X')->afterUpdate()->on('A')->run(
                Select::from('A')
            )->temporary()
        );
    }

    public function test_create_temp_trigger_insteadof_update()
    {
        $this->sql(
            Create::trigger('T')->insteadOfUpdate()->on('X')->run(
                Select::from('A')
            )->temporary()
        );
    }

    public function test_create_temp_trigger_update_when()
    {
        $this->sql(
            Create::trigger('X')->update()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->temporary()
        );
    }

    public function test_create_temp_trigger_before_update_when()
    {
        $this->sql(
            Create::trigger('X')->beforeUpdate()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->temporary()
        );
    }

    public function test_create_temp_trigger_after_update_when()
    {
        $this->sql(
            Create::trigger('X')->afterUpdate()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->temporary()
        );
    }

    public function test_create_temp_trigger_insteadof_update_when()
    {
        $this->sql(
            Create::trigger('T')->insteadOfUpdate()->on('X')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->temporary()
        );
    }

    // update of

    public function test_create_trigger_update_of()
    {
        $this->sql(
            Create::trigger('X')->update()->on('A')->run(
                Select::from('A')
            )->of("a", "b"),

            Create::trigger('X')->update("a", "b")->on('A')->run(
                Select::from('A')
            )
        );
    }

    public function test_create_trigger_before_update_of()
    {
        $this->sql(
            Create::trigger('X')->beforeUpdate()->on('A')->run(
                Select::from('A')
            )->of("a", "b"),

            Create::trigger('X')->beforeUpdate("a", "b")->on('A')->run(
                Select::from('A')
            )
        );
    }

    public function test_create_trigger_after_update_of()
    {
        $this->sql(
            Create::trigger('X')->afterUpdate()->on('A')->run(
                Select::from('A')
            )->of("a", "b"),

            Create::trigger('X')->afterUpdate("a", "b")->on('A')->run(
                Select::from('A')
            )
        );
    }

    public function test_create_trigger_insteadof_update_of()
    {
        $this->sql(
            Create::trigger('T')->insteadOfUpdate()->on('X')->run(
                Select::from('A')
            )->of("a", "b"),

            Create::trigger('T')->insteadOfUpdate("a", "b")->on('X')->run(
                Select::from('A')
            )
        );
    }

    public function test_create_trigger_update_of_when()
    {
        $this->sql(
            Create::trigger('X')->update()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->of("a", "b"),

            Create::trigger('X')->update("a", "b")->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)
        );
    }

    public function test_create_trigger_before_update_of_when()
    {
        $this->sql(
            Create::trigger('X')->beforeUpdate()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->of("a", "b"),

            Create::trigger('X')->beforeUpdate("a", "b")->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)
        );
    }

    public function test_create_trigger_after_update_of_when()
    {
        $this->sql(
            Create::trigger('X')->afterUpdate()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->of("a", "b"),

            Create::trigger('X')->afterUpdate("a", "b")->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)
        );
    }

    public function test_create_trigger_insteadof_update_of_when()
    {
        $this->sql(
            Create::trigger('T')->insteadOfUpdate()->on('X')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->of("a", "b"),

            Create::trigger('T')->insteadOfUpdate("a", "b")->on('X')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)
        );
    }

    //

    public function test_create_temp_trigger_update_of()
    {
        $this->sql(
            Create::trigger('X')->update()->on('A')->run(
                Select::from('A')
            )->of("a", "b")->temporary(),

            Create::trigger('X')->update("a", "b")->on('A')->run(
                Select::from('A')
            )->temporary()
        );
    }

    public function test_create_temp_trigger_before_update_of()
    {
        $this->sql(
            Create::trigger('X')->beforeUpdate()->on('A')->run(
                Select::from('A')
            )->of("a", "b")->temporary(),

            Create::trigger('X')->beforeUpdate("a", "b")->on('A')->run(
                Select::from('A')
            )->temporary()
        );
    }

    public function test_create_temp_trigger_after_update_of()
    {
        $this->sql(
            Create::trigger('X')->afterUpdate()->on('A')->run(
                Select::from('A')
            )->of("a", "b")->temporary(),

            Create::trigger('X')->afterUpdate("a", "b")->on('A')->run(
                Select::from('A')
            )->temporary()
        );
    }

    public function test_create_temp_trigger_insteadof_update_of()
    {
        $this->sql(
            Create::trigger('T')->insteadOfUpdate()->on('X')->run(
                Select::from('A')
            )->of("a", "b")->temporary(),

            Create::trigger('T')->insteadOfUpdate("a", "b")->on('X')->run(
                Select::from('A')
            )->temporary()
        );
    }

    public function test_create_temp_trigger_update_of_when()
    {
        $this->sql(
            Create::trigger('X')->update()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->of("a", "b")->temporary(),

            Create::trigger('X')->update("a", "b")->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->temporary()
        );
    }

    public function test_create_temp_trigger_before_update_of_when()
    {
        $this->sql(
            Create::trigger('X')->beforeUpdate()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->of("a", "b")->temporary(),

            Create::trigger('X')->beforeUpdate("a", "b")->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->temporary()
        );
    }

    public function test_create_temp_trigger_after_update_of_when()
    {
        $this->sql(
            Create::trigger('X')->afterUpdate()->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->of("a", "b")->temporary(),

            Create::trigger('X')->afterUpdate("a", "b")->on('A')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->temporary()
        );
    }

    public function test_create_temp_trigger_insteadof_update_of_when()
    {
        $this->sql(
            Create::trigger('T')->insteadOfUpdate()->on('X')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->of("a", "b")->temporary(),

            Create::trigger('T')->insteadOfUpdate("a", "b")->on('X')->run(
                Select::from('A')
            )->when("a", "=", 0)->orWhen("b", ">", 0)->temporary()
        );
    }

    ////////

    // indexes

    public function test_create_index()
    {
        $this->sql(
            Create::index('I')->on('A')->columns("a", "b"),
            Create::index('I')->on('A')->columns(["a", "b"])
        );
    }

    public function test_create_unique_index()
    {
        $this->sql(
            Create::index('I')->on('A')->columns("a", "b")->unique(),
            Create::index('I')->on('A')->columns(["a", "b"])->unique()
        );
    }

    public function test_create_index_where()
    {
        $this->sql(
            Create::index('I')->on('A')->columns("a", "b")->where("a", "=", 0),
            Create::index('I')->on('A')->columns(["a", "b"])->where("a", "=", 0)
        );
    }

    public function test_create_unique_index_where()
    {
        $this->sql(
            Create::index('I')->on('A')->columns("a", "b")->unique()->where("a", "=", 0),
            Create::index('I')->on('A')->columns(["a", "b"])->unique()->where("a", "=", 0)
        );
    }

    // views

    public function test_create_view()
    {
        $this->sql(
            Create::view('V')->using(Select::from("A"))
        );
    }

    public function test_create_temporary_view()
    {
        $this->sql(
            Create::view('V')->using(Select::from("A"))->temporary()
        );
    }
}
