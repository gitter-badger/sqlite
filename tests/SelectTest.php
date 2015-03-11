<?php

namespace Concat\SQLite\Tests;

use Concat\SQLite\Select;

class SelectTest extends \PHPUnit_Framework_TestCase
{
    use StatementTest;

    protected static $key = "select";

    ///////////
    public function test_select()
    {
        $this->sql(
            Select::from("A")
        );
    }

    public function test_select_from_subquery()
    {
        $this->sql(
            Select::from(Select::from("A"))
        );
    }

    public function test_select_from_column_subquery()
    {
        $this->sql(
            Select::only(Select::only("a")->from("A"))->from("B")
        );
    }

    public function test_select_aliased()
    {
        $this->sql(
            Select::from("A as B"),
            Select::from("A AS B")
        );
    }

    public function test_select_from_multiple_tables()
    {
        $this->sql(
            Select::from("A", "B")
        );
    }

    public function test_select_columns()
    {
        $this->sql(
            Select::only("a", "b")->from("A")
        );
    }

    public function test_select_columns_from_multiple_tables()
    {
        $this->sql(
            Select::only("A.a", "B.b")->from("A", "B"),
            Select::from("A", "B")->only("A.a", "B.b")
        );
    }

    //////

    public function test_select_grouped()
    {
        $this->sql(
            Select::from("A")->groupBy("a"),
            Select::from("A")->groupBy(["a"])
        );
    }

    public function test_select_grouped_columns()
    {
        $this->sql(
            Select::from("A")->groupBy("a", "b"),
            Select::from("A")->groupBy(["a", "b"])
        );
    }

    public function test_select_grouped_expression()
    {
        $this->sql(
            Select::from("A")->groupBy(Select::only('a')->from("B")),
            Select::from("A")->groupBy("(SELECT a FROM B)")
        );
    }

    public function test_select_grouped_having()
    {
        $this->sql(
            Select::from("A")->groupBy("a")->having("a", ">", 0),
            Select::from("A")->groupBy("a")->having("a > 0"),
            Select::from("A")->groupBy(["a"])->having("a", ">", 0)
        );
    }

    public function test_select_grouped_columns_having()
    {
        $this->sql(
            Select::from("A")->groupBy("a", "b")->having("a", ">", 0),
            Select::from("A")->groupBy("a", "b")->having("a > 0"),
            Select::from("A")->groupBy(["a", "b"])->having("a", ">", 0)
        );
    }

    public function test_select_grouped_expression_having()
    {
        $this->sql(
            Select::from("A")->groupBy(Select::only('a')->from("B"))->having("a", ">", 0),
            Select::from("A")->groupBy(Select::only('a')->from("B"))->having("a > 0"),
            Select::from("A")->groupBy("(SELECT a FROM B)")->having("a", ">", 0)
        );
    }

    //


    /**
     * @expectedException \Concat\SQLite\SQLiteException
     */
    public function test_select_grouped_or_having_before_having()
    {
        $this->sql(
            Select::from("A")->groupBy("a")->orHaving("b", "=", 1)->having("a", ">", 0)
        );
    }

    public function test_select_grouped_or_having()
    {
        $this->sql(
            Select::from("A")->groupBy("a")->having("a", ">", 0)->orHaving("b", "=", 1),
            Select::from("A")->groupBy("a")->having("a > 0")->orHaving("b = 1"),
            Select::from("A")->groupBy(["a"])->having("a", ">", 0)->orHaving("b", "=", 1)
        );
    }

    public function test_select_grouped_columns_or_having()
    {
        $this->sql(
            Select::from("A")->groupBy("a", "b")->having("a", ">", 0)->orHaving("b", "=", 1),
            Select::from("A")->groupBy("a", "b")->having("a > 0")->orHaving("b = 1"),
            Select::from("A")->groupBy(["a", "b"])->having("a", ">", 0)->orHaving("b", "=", 1)
        );
    }

    public function test_select_grouped_expression_or_having()
    {
        $this->sql(
            Select::from("A")->groupBy(Select::only('a')->from("B"))->having("a", ">", 0)->orHaving("b", "=", 1),
            Select::from("A")->groupBy(Select::only('a')->from("B"))->having("a > 0")->orHaving("b = 1"),
            Select::from("A")->groupBy("(SELECT a FROM B)")->having("a", ">", 0)->orHaving("b", "=", 1)
        );
    }

    //

    public function test_select_grouped_and_having()
    {
        $this->sql(
            Select::from("A")->groupBy("a")->having("a", ">", 0)->having("b", "=", 1),
            Select::from("A")->groupBy("a")->having("a > 0")->having("b = 1"),
            Select::from("A")->groupBy(["a"])->having("a", ">", 0)->having("b", "=", 1)
        );
    }

    public function test_select_grouped_columns_and_having()
    {
        $this->sql(
            Select::from("A")->groupBy("a", "b")->having("a", ">", 0)->having("b", "=", 1),
            Select::from("A")->groupBy("a", "b")->having("a > 0")->having("b = 1"),
            Select::from("A")->groupBy(["a", "b"])->having("a", ">", 0)->having("b", "=", 1)
        );
    }

    public function test_select_grouped_expression_and_having()
    {
        $this->sql(
            Select::from("A")->groupBy(Select::only('a')->from("B"))->having("a", ">", 0)->having("b", "=", 1),
            Select::from("A")->groupBy(Select::only('a')->from("B"))->having("a > 0")->having("b = 1"),
            Select::from("A")->groupBy("(SELECT a FROM B)")->having("a", ">", 0)->having("b", "=", 1)
        );
    }

    //////////

        public function test_select_order_by()
        {
            $this->sql(
                Select::from("A")->orderBy("a"),
                Select::from("A")->orderBy(["a"])
            );
        }

    public function test_select_order_by_many()
    {
        $this->sql(
                Select::from("A")->orderBy("a", "b"),
                Select::from("A")->orderBy(["a", "b"])
            );
    }

    public function test_select_order_by_asc()
    {
        $this->sql(
                Select::from("A")->orderBy("a ASC", "b"),
                Select::from("A")->orderBy("a")->ascending()->orderBy("b"),
                Select::from("A")->ascending("a")->orderBy("b"),
                Select::from("A")->ascending(["a"])->orderBy("b")
            );
    }

    public function test_select_order_by_desc()
    {
        $this->sql(
                Select::from("A")->orderBy("a DESC", "b"),
                Select::from("A")->orderBy("a")->descending()->orderBy("b"),
                Select::from("A")->descending("a")->orderBy("b"),
                Select::from("A")->descending(["a"])->orderBy("b")
            );
    }

    public function test_select_order_by_asc_desc()
    {
        $this->sql(
                Select::from("A")->orderBy("a ASC", "b DESC"),
                Select::from("A")->orderBy("a")->ascending()->orderBy("b")->descending(),
                Select::from("A")->ascending("a")->descending("b"),
                Select::from("A")->ascending(["a"])->descending(["b"])
            );
    }

        /**
         * @expectedException \Concat\SQLite\SQLiteException
         */
        public function test_select_nocase_before_order_by()
        {
            $this->sql(
                Select::from("A")->nocase()->orderBy("a DESC", "b")
            );
        }

    public function test_select_order_by_nocase()
    {
        $this->sql(
                Select::from("A")->orderBy("a")->nocase(),
                Select::from("A")->orderBy(["a"])->nocase(),
                Select::from("A")->orderBy("a")->insensitive(),
                Select::from("A")->orderBy(["a"])->insensitive()
            );
    }

    public function test_select_order_by_many_nocase()
    {
        $this->sql(
                Select::from("A")->orderBy("a", "b")->nocase(),
                Select::from("A")->orderBy(["a", "b"])->nocase(),
                Select::from("A")->orderBy("a", "b")->insensitive(),
                Select::from("A")->orderBy(["a", "b"])->insensitive()
            );
    }

    public function test_select_order_by_asc_nocase()
    {
        $this->sql(
                Select::from("A")->orderBy("a ASC", "b")->nocase(),
                Select::from("A")->orderBy("a ASC", "b")->insensitive(),
                Select::from("A")->orderBy("a ASC", "b")->nocase(),
                Select::from("A")->orderBy("a ASC", "b")->insensitive(),

                Select::from("A")->orderBy("a")->ascending()->orderBy("b")->nocase(),
                Select::from("A")->orderBy("a")->ascending()->orderBy("b")->insensitive(),

                Select::from("A")->orderBy("a")->asc()->orderBy("b")->nocase(),
                Select::from("A")->orderBy("a")->asc()->orderBy("b")->insensitive(),

                Select::from("A")->ascending("a")->orderBy("b")->nocase(),
                Select::from("A")->ascending("a")->orderBy("b")->insensitive(),
                Select::from("A")->ascending(["a"])->orderBy("b")->nocase(),
                Select::from("A")->ascending(["a"])->orderBy("b")->insensitive(),

                Select::from("A")->asc("a")->orderBy("b")->nocase(),
                Select::from("A")->asc("a")->orderBy("b")->insensitive(),
                Select::from("A")->asc(["a"])->orderBy("b")->nocase(),
                Select::from("A")->asc(["a"])->orderBy("b")->insensitive()
            );
    }

    public function test_select_order_by_desc_nocase()
    {
        $this->sql(
                Select::from("A")->orderBy("a DESC", "b")->nocase(),
                Select::from("A")->orderBy("a DESC", "b")->insensitive(),

                Select::from("A")->orderBy("a")->descending()->orderBy("b")->nocase(),
                Select::from("A")->orderBy("a")->descending()->orderBy("b")->insensitive(),

                Select::from("A")->orderBy("a")->desc()->orderBy("b")->nocase(),
                Select::from("A")->orderBy("a")->desc()->orderBy("b")->insensitive(),
                Select::from("A")->orderBy("a DESC", "b")->insensitive(),

                Select::from("A")->descending("a")->orderBy("b")->nocase(),
                Select::from("A")->descending("a")->orderBy("b")->insensitive(),
                Select::from("A")->descending(["a"])->orderBy("b")->nocase(),
                Select::from("A")->descending(["a"])->orderBy("b")->insensitive(),

                Select::from("A")->desc("a")->orderBy("b")->nocase(),
                Select::from("A")->desc("a")->orderBy("b")->insensitive(),
                Select::from("A")->desc(["a"])->orderBy("b")->nocase(),
                Select::from("A")->desc(["a"])->orderBy("b")->insensitive()
            );
    }

    public function test_select_order_by_asc_desc_nocase()
    {
        $this->sql(
                Select::from("A")->orderBy("a")->ascending()->orderBy("b")->descending()->nocase(),
                Select::from("A")->orderBy("a")->ascending()->orderBy("b")->descending()->insensitive(),
                Select::from("A")->orderBy("a")->asc()->orderBy("b")->desc()->nocase(),
                Select::from("A")->orderBy("a")->asc()->orderBy("b")->desc()->insensitive(),

                Select::from("A")->ascending("a")->descending("b")->nocase(),
                Select::from("A")->ascending("a")->descending("b")->insensitive(),
                Select::from("A")->ascending(["a"])->descending(["b"])->nocase(),
                Select::from("A")->ascending(["a"])->descending(["b"])->insensitive(),

                Select::from("A")->asc("a")->desc("b")->nocase(),
                Select::from("A")->asc("a")->desc("b")->insensitive(),
                Select::from("A")->asc(["a"])->desc(["b"])->nocase(),
                Select::from("A")->asc(["a"])->desc(["b"])->insensitive()
            );
    }

    ///////

    public function test_select_limit()
    {
        $this->sql(
            Select::from("A")->limit(1)
        );
    }

    public function test_select_from_subquery_limit()
    {
        $this->sql(
            Select::from(Select::from("A"))->limit(1)
        );
    }

    public function test_select_from_column_subquery_limit()
    {
        $this->sql(
            Select::only(Select::only("a")->from("A"))->from("B")->limit(1)
        );
    }

    public function test_select_aliased_limit()
    {
        $this->sql(
            Select::from("A as B")->limit(1),
            Select::from("A AS B")->limit(1)
        );
    }

    public function test_select_from_multiple_tables_limit()
    {
        $this->sql(
            Select::from("A", "B")->limit(1)
        );
    }

    public function test_select_columns_limit()
    {
        $this->sql(
            Select::only("a", "b")->from("A")->limit(1)
        );
    }

    public function test_select_columns_from_multiple_tables_limit()
    {
        $this->sql(
            Select::only("A.a", "B.b")->from("A", "B")->limit(1),
            Select::from("A", "B")->only("A.a", "B.b")->limit(1)
        );
    }

    ///////

    public function test_select_limit_offset()
    {
        $this->sql(
            Select::from("A")->limit(1)->offset(10),
            Select::from("A")->limit(1, 10)

        );
    }

    public function test_select_from_subquery_limit_offset()
    {
        $this->sql(
            Select::from(Select::from("A"))->limit(1)->offset(10),
            Select::from(Select::from("A"))->limit(1, 10)
        );
    }

    public function test_select_from_column_subquery_limit_offset()
    {
        $this->sql(
            Select::only(Select::only("a")->from("A"))->from("B")->limit(1)->offset(10),
            Select::only(Select::only("a")->from("A"))->from("B")->limit(1, 10)
        );
    }

    public function test_select_aliased_limit_offset()
    {
        $this->sql(
            Select::from("A as B")->limit(1)->offset(10),
            Select::from("A AS B")->limit(1)->offset(10),
            Select::from("A as B")->limit(1, 10),
            Select::from("A AS B")->limit(1, 10)
        );
    }

    public function test_select_from_multiple_tables_limit_offset()
    {
        $this->sql(
            Select::from("A", "B")->limit(1)->offset(10),
            Select::from("A", "B")->limit(1, 10)

        );
    }

    public function test_select_columns_limit_offset()
    {
        $this->sql(
            Select::only("a", "b")->from("A")->limit(1)->offset(10),
            Select::only("a", "b")->from("A")->limit(1, 10)
        );
    }

    public function test_select_columns_from_multiple_tables_limit_offset()
    {
        $this->sql(
            Select::only("A.a", "B.b")->from("A", "B")->limit(1)->offset(10),
            Select::from("A", "B")->only("A.a", "B.b")->limit(1)->offset(10),
            Select::only("A.a", "B.b")->from("A", "B")->limit(1, 10),
            Select::from("A", "B")->only("A.a", "B.b")->limit(1, 10)
        );
    }

    ///////


    public function test_select_union()
    {
        $this->sql(
            Select::from('A')->union(Select::from('B'))
        );
    }

    public function test_select_union_all()
    {
        $this->sql(
            Select::from('A')->unionAll(Select::from('B'))
        );
    }

    public function test_select_intersect()
    {
        $this->sql(
            Select::from('A')->intersect(Select::from('B'))
        );
    }

    public function test_select_except()
    {
        $this->sql(
            Select::from('A')->except(Select::from('B'))
        );
    }

    public function test_select_union_many()
    {
        $this->sql(
            Select::from('A')->union(Select::from('B'))->union(Select::from('C')),
            Select::from('A')->union([Select::from('B'), Select::from('C')]),
            Select::from('A')->union(Select::from('B'), Select::from('C'))
        );
    }

    public function test_select_union_all_many()
    {
        $this->sql(
            Select::from('A')->unionAll(Select::from('B'))->unionAll(Select::from('C')),
            Select::from('A')->unionAll([Select::from('B'), Select::from('C')]),
            Select::from('A')->unionAll(Select::from('B'), Select::from('C'))
        );
    }

    public function test_select_intersect_many()
    {
        $this->sql(
            Select::from('A')->intersect(Select::from('B'))->intersect(Select::from('C')),
            Select::from('A')->intersect([Select::from('B'), Select::from('C')]),
            Select::from('A')->intersect(Select::from('B'), Select::from('C'))
        );
    }

    public function test_select_except_many()
    {
        $this->sql(
            Select::from('A')->except(Select::from('B'))->except(Select::from('C')),
            Select::from('A')->except([Select::from('B'), Select::from('C')]),
            Select::from('A')->except(Select::from('B'), Select::from('C'))
        );
    }

    public function test_select_compound()
    {
        $this->sql(
            Select::from('A')->union(Select::from('B'))->intersect(Select::from("C"))
        );
    }

    public function test_select_compound_nested()
    {
        $this->sql(
            Select::from('A')->union(Select::from('B')->union(Select::from("C")))
        );
    }

    /////


    public function test_distinct_select_columns()
    {
        $this->sql(
            Select::only("a", "b")->from("A")->distinct()
        );
    }

    public function test_distinct_select_columns_from_many()
    {
        $this->sql(
            Select::only("A.a", "B.b")->from("A", "B")->distinct(),
            Select::from("A", "B")->only("A.a", "B.b")->distinct()
        );
    }

    public function test_where_greater()
    {
        $this->sql(
            Select::from("A")->where("b", ">", "c"),
            Select::from("A")->where("b > 'c'")
        );
    }

    public function test_where_in_array()
    {
        $this->sql(
            Select::from("A")->where("b", "in", [1, 2, 3])
        );
    }

    public function test_where_in_subquery()
    {
        $this->sql(
            Select::from("A")->where("b", "in", Select::only("a")->from("C"))
        );
    }

    public function test_where_in_from_subquery()
    {
        $this->sql(
            Select::from("A")->where(Select::only("a")->from("B"), ">", "c")
        );
    }

    public function test_or_where()
    {
        $this->sql(
            Select::from("A")
                ->where("a", ">", "a")
                ->orWhere("b", "=", "b")
        );
    }

    public function test_or_multiple_where()
    {
        $this->sql(
            Select::from("A")
                ->where("a", ">", "a")
                ->where("b", "=", "b")
                ->orWhere("c", "<", "c")
        );
    }

    public function test_or_where_subquery()
    {
        $this->sql(
            Select::from("A")
                ->where(Select::only("a")->from("B"), ">", "d")
                ->orWhere(Select::only("a")->from("C"), "=", "e")
        );
    }

    ///////


    public function test_join()
    {
        $this->sql(
            Select::from("A")->join("B")->on("A.c = B.c"),
            Select::from("A")->join("B")->onColumns("c")
        );
    }

    public function test_join_aliased()
    {
        $this->sql(
            Select::from("A as X")->join("B")->on("X.c = B.c"),
            Select::from("A as X")->join("B")->onColumns("c"),

            Select::from("A AS X")->join("B")->on("X.c = B.c"),
            Select::from("A AS X")->join("B")->onColumns("c")
        );
    }

    public function test_join_aliased_alternative()
    {
        $this->sql(
            Select::from("A")->join("B", "X")->on("A.c = X.c"),
            Select::from("A")->join("B", "X")->onColumns("c")
        );
    }

    public function test_join_with_and()
    {
        $this->sql(
            Select::from("A")->join("B")->on("A.b = B.b AND A.c = B.c"),
            Select::from("A")->join("B")->onColumns("b", "c")
        );
    }

    public function test_join_with_subquery()
    {
        $this->sql(
            Select::from("A")->join(Select::from("B"), "X")->on("A.b = X.b AND A.c = X.c")
        );
    }

    public function test_join_using()
    {
        $this->sql(
            Select::from("A")->join("B")->using("a", "b")
        );
    }

    public function test_left_join()
    {
        $this->sql(
            Select::from("A")->leftJoin("B")->on("A.c = B.c"),
            Select::from("A")->leftJoin("B")->onColumns("c")
        );
    }

    public function test_left_outer_join()
    {
        $this->sql(
            Select::from("A")->leftOuterJoin("B")->on("A.c = B.c"),
            Select::from("A")->leftOuterJoin("B")->onColumns("c")
        );
    }

    public function test_natural_join()
    {
        $this->sql(
            Select::from("A")->naturalJoin("B")
        );
    }

    public function test_natural_left_join()
    {
        $this->sql(
            Select::from("A")->naturalLeftJoin("B")
        );
    }

    public function test_natural_left_outer_join()
    {
        $this->sql(
            Select::from("A")->naturalLeftOuterJoin("B")
        );
    }

    ///// Named prepared

    public function test_prepared_named_where_greater()
    {
        $this->sql(
            Select::from("A")->where("a", ">", ":a"),
            Select::from("A")->where("a > :a")
        );
    }

    public function test_prepared_named_where_in_from_subquery()
    {
        $this->sql(
            Select::from("A")->where(Select::only("a")->from("B"), ">", ":c")
        );
    }

    public function test_prepared_named_or_where()
    {
        $this->sql(
            Select::from("A")
                ->where("a", ">", ":a")
                ->orWhere("b", "=", ":b"),

            Select::from("A")
                ->where("a > :a")
                ->orWhere("b = :b")
        );
    }

    public function test_prepared_named_or_multiple_where()
    {
        $this->sql(
            Select::from("A")
                ->where("a", ">", ":a")
                ->where("b", "=", ":b")
                ->orWhere("c", "<", ":c"),

            Select::from("A")
                ->where("a > :a")
                ->where("b = :b")
                ->orWhere("c < :c")
        );
    }

    public function test_prepared_named_or_where_subquery()
    {
        $this->sql(
            Select::from("A")
                ->where(Select::only("a")->from("B"), ">", ":a")
                ->orWhere(Select::only("a")->from("C"), "=", ":b")
        );
    }
    public function test_prepared_named_join()
    {
        $this->sql(
            Select::from("A")->join("B")->on("A.c = :c")
        );
    }

    public function test_prepared_named_join_aliased()
    {
        $this->sql(
            Select::from("A as X")->join("B")->on("X.c = :c")
        );
    }

    public function test_prepared_named_join_aliased_alternative()
    {
        $this->sql(
            Select::from("A")->join("B", "X")->on("A.c = :c")
        );
    }

    public function test_prepared_named_join_with_and()
    {
        $this->sql(
            Select::from("A")->join("B")->on("A.b = :b AND A.c = :c")
        );
    }

    public function test_prepared_named_join_with_subquery()
    {
        $this->sql(
            Select::from("A")->join(Select::from("B"), "X")->on("A.b = :b AND A.c = :c")
        );
    }

    public function test_prepared_named_left_join()
    {
        $this->sql(
            Select::from("A")->leftJoin("B")->on("A.c = :c")
        );
    }

    public function test_prepared_named_left_outer_join()
    {
        $this->sql(
            Select::from("A")->leftOuterJoin("B")->on("A.c = :c")
        );
    }

      ///// ? prepared

    public function test_prepared_where_greater()
    {
        $this->sql(
            Select::from("A")->where("a", ">", "?"),
            Select::from("A")->where("a > ?")
        );
    }

    public function test_prepared_where_in_from_subquery()
    {
        $this->sql(
            Select::from("A")->where(Select::only("a")->from("B"), ">", "?")
        );
    }

    public function test_prepared_or_where()
    {
        $this->sql(
            Select::from("A")
                ->where("a", ">", "?")
                ->orWhere("b", "=", "?"),

            Select::from("A")
                ->where("a > ?")
                ->orWhere("b = ?")
        );
    }

    public function test_prepared_or_multiple_where()
    {
        $this->sql(
            Select::from("A")
                ->where("a", ">", "?")
                ->where("b", "=", "?")
                ->orWhere("c", "<", "?"),

            Select::from("A")
                ->where("a > ?")
                ->where("b = ?")
                ->orWhere("c < ?")
        );
    }

    public function test_prepared_or_where_subquery()
    {
        $this->sql(
            Select::from("A")
                ->where(Select::only("a")->from("B"), ">", "?")
                ->orWhere(Select::only("a")->from("C"), "=", "?")
        );
    }
    public function test_prepared_join()
    {
        $this->sql(
            Select::from("A")->join("B")->on("A.c = ?")
        );
    }

    public function test_prepared_join_aliased()
    {
        $this->sql(
            Select::from("A as X")->join("B")->on("X.c = ?")
        );
    }

    public function test_prepared_join_aliased_alternative()
    {
        $this->sql(
            Select::from("A")->join("B", "X")->on("A.c = ?")
        );
    }

    public function test_prepared_join_with_and()
    {
        $this->sql(
            Select::from("A")->join("B")->on("A.b = ? AND A.c = ?")
        );
    }

    public function test_prepared_join_with_subquery()
    {
        $this->sql(
            Select::from("A")->join(Select::from("B"), "X")->on("A.b = ? AND A.c = ?")
        );
    }

    public function test_prepared_left_join()
    {
        $this->sql(
            Select::from("A")->leftJoin("B")->on("A.c = ?")
        );
    }

    public function test_prepared_left_outer_join()
    {
        $this->sql(
            Select::from("A")->leftOuterJoin("B")->on("A.c = ?")
        );
    }

    //// Exceptions


    /**
     * @expectedException \Concat\SQLite\SQLiteException
     */
    public function test_or_where_before_where()
    {
        $this->sql(
            Select::from("A")
                ->orWhere("b", ">", "c")
                ->where("d", "=", "c")
        );
    }

    /**
     * @expectedException \Concat\SQLite\SQLiteException
     */
    public function test_natural_join_using()
    {
        $this->sql(
            Select::from("A")->naturalJoin("B")->using("a", "b", "c")
        );
    }

    /**
     * @expectedException \Concat\SQLite\SQLiteException
     */
    public function test_natural_join_on()
    {
        $this->sql(
            Select::from("A")->naturalJoin("B")->on("A.a = B.a")
        );
    }

    /**
     * @expectedException \Concat\SQLite\SQLiteException
     */
    public function test_on_before_join()
    {
        $this->sql(
            Select::from("A")->on("A.a = B.a")->join("B")
        );
    }

    /**
     * @expectedException \Concat\SQLite\SQLiteException
     */
    public function test_on_columns_before_join()
    {
        $this->sql(
            Select::from("A")->onColumns("A.a = B.a")->join("B")
        );
    }

    /**
     * @expectedException \Concat\SQLite\SQLiteException
     */
    public function test_using_before_join()
    {
        $this->sql(
            Select::from("A")->using("a", "b", "c")->join("B")
        );
    }
}
