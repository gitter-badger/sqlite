<?php

return [

    'select' => [
        "select"                               => "SELECT * FROM A",
        "select_from_subquery"                 => "SELECT * FROM (SELECT * FROM A)",
        "select_from_column_subquery"          => "SELECT (SELECT a FROM A) FROM B",
        "select_aliased"                       => "SELECT * FROM A AS B",
        "select_from_multiple_tables"          => "SELECT * FROM A,B",
        "select_columns"                       => "SELECT a,b FROM A",
        "select_columns_from_multiple_tables"  => "SELECT A.a,B.b FROM A,B",

        "select_grouped"                       => "SELECT * FROM A GROUP BY a",
        "select_grouped_columns"               => "SELECT * FROM A GROUP BY a,b",
        "select_grouped_expression"            => "SELECT * FROM A GROUP BY (SELECT a FROM B)",

        "select_grouped_having"                => "SELECT * FROM A GROUP BY a HAVING a > 0",
        "select_grouped_columns_having"        => "SELECT * FROM A GROUP BY a,b HAVING a > 0",
        "select_grouped_expression_having"     => "SELECT * FROM A GROUP BY (SELECT a FROM B) HAVING a > 0",

        "select_grouped_or_having"                => "SELECT * FROM A GROUP BY a HAVING a > 0 OR b = 1",
        "select_grouped_columns_or_having"        => "SELECT * FROM A GROUP BY a,b HAVING a > 0 OR b = 1",
        "select_grouped_expression_or_having"     => "SELECT * FROM A GROUP BY (SELECT a FROM B) HAVING a > 0 OR b = 1",

        "select_grouped_and_having"                => "SELECT * FROM A GROUP BY a HAVING a > 0 AND b = 1",
        "select_grouped_columns_and_having"        => "SELECT * FROM A GROUP BY a,b HAVING a > 0 AND b = 1",
        "select_grouped_expression_and_having"     => "SELECT * FROM A GROUP BY (SELECT a FROM B) HAVING a > 0 AND b = 1",

        "select_limit"                               => "SELECT * FROM A LIMIT 1",
        "select_from_subquery_limit"                 => "SELECT * FROM (SELECT * FROM A) LIMIT 1",
        "select_from_column_subquery_limit"          => "SELECT (SELECT a FROM A) FROM B LIMIT 1",
        "select_aliased_limit"                       => "SELECT * FROM A AS B LIMIT 1",
        "select_from_multiple_tables_limit"          => "SELECT * FROM A,B LIMIT 1",
        "select_columns_limit"                       => "SELECT a,b FROM A LIMIT 1",
        "select_columns_from_multiple_tables_limit"  => "SELECT A.a,B.b FROM A,B LIMIT 1",

        "select_limit_offset"                               => "SELECT * FROM A LIMIT 1 OFFSET 10",
        "select_from_subquery_limit_offset"                 => "SELECT * FROM (SELECT * FROM A) LIMIT 1 OFFSET 10",
        "select_from_column_subquery_limit_offset"          => "SELECT (SELECT a FROM A) FROM B LIMIT 1 OFFSET 10",
        "select_aliased_limit_offset"                       => "SELECT * FROM A AS B LIMIT 1 OFFSET 10",
        "select_from_multiple_tables_limit_offset"          => "SELECT * FROM A,B LIMIT 1 OFFSET 10",
        "select_columns_limit_offset"                       => "SELECT a,b FROM A LIMIT 1 OFFSET 10",
        "select_columns_from_multiple_tables_limit_offset"  => "SELECT A.a,B.b FROM A,B LIMIT 1 OFFSET 10",

        "select_union"                                => "SELECT * FROM A UNION SELECT * FROM B",
        "select_union_all"                            => "SELECT * FROM A UNION ALL SELECT * FROM B",
        "select_intersect"                            => "SELECT * FROM A INTERSECT SELECT * FROM B",
        "select_except"                               => "SELECT * FROM A EXCEPT SELECT * FROM B",

        "select_union_many"                    => "SELECT * FROM A UNION SELECT * FROM B UNION SELECT * FROM C",
        "select_union_all_many"                => "SELECT * FROM A UNION ALL SELECT * FROM B UNION ALL SELECT * FROM C",
        "select_intersect_many"                => "SELECT * FROM A INTERSECT SELECT * FROM B INTERSECT SELECT * FROM C",
        "select_except_many"                   => "SELECT * FROM A EXCEPT SELECT * FROM B EXCEPT SELECT * FROM C",
        "select_compound"                      => "SELECT * FROM A UNION SELECT * FROM B INTERSECT SELECT * FROM C",
        "select_compound_nested"               => "SELECT * FROM A UNION SELECT * FROM B UNION SELECT * FROM C",

        "select_order_by"                      => "SELECT * FROM A ORDER BY a",
        "select_order_by_many"                 => "SELECT * FROM A ORDER BY a,b",
        "select_order_by_asc"                  => "SELECT * FROM A ORDER BY a ASC,b",
        "select_order_by_desc"                 => "SELECT * FROM A ORDER BY a DESC,b",
        "select_order_by_asc_desc"             => "SELECT * FROM A ORDER BY a ASC,b DESC",

        "select_order_by_nocase"               => "SELECT * FROM A ORDER BY a COLLATE NOCASE",
        "select_order_by_many_nocase"          => "SELECT * FROM A ORDER BY a,b COLLATE NOCASE",
        "select_order_by_asc_nocase"           => "SELECT * FROM A ORDER BY a ASC,b COLLATE NOCASE",
        "select_order_by_desc_nocase"          => "SELECT * FROM A ORDER BY a DESC,b COLLATE NOCASE",
        "select_order_by_asc_desc_nocase"      => "SELECT * FROM A ORDER BY a ASC,b COLLATE NOCASE DESC",

        "distinct_select_columns"              => "SELECT DISTINCT a,b FROM A",
        "distinct_select_columns_from_many"    => "SELECT DISTINCT A.a,B.b FROM A,B",

        "where_greater"                        => "SELECT * FROM A WHERE b > 'c'",
        "where_in_array"                       => "SELECT * FROM A WHERE b IN (1,2,3)",
        "where_in_subquery"                    => "SELECT * FROM A WHERE b IN (SELECT a FROM C)",
        "where_in_from_subquery"               => "SELECT * FROM A WHERE (SELECT a FROM B) > 'c'",
        "or_where"                             => "SELECT * FROM A WHERE a > 'a' OR b = 'b'",
        "or_multiple_where"                    => "SELECT * FROM A WHERE a > 'a' AND b = 'b' OR c < 'c'",
        "or_where_subquery"                    => "SELECT * FROM A WHERE (SELECT a FROM B) > 'd' OR (SELECT a FROM C) = 'e'",

        "join"                                 => "SELECT * FROM A INNER JOIN B ON A.c = B.c",
        "join_aliased"                         => "SELECT * FROM A AS X INNER JOIN B ON X.c = B.c",
        "join_aliased_alternative"             => "SELECT * FROM A INNER JOIN B AS X ON A.c = X.c",

        "join_with_and"                        => "SELECT * FROM A INNER JOIN B ON A.b = B.b AND A.c = B.c",
        "join_with_subquery"                   => "SELECT * FROM A INNER JOIN (SELECT * FROM B) AS X ON A.b = X.b AND A.c = X.c",
        "join_using"                           => "SELECT * FROM A INNER JOIN B USING (a,b)",

        "left_join"                            => "SELECT * FROM A LEFT JOIN B ON A.c = B.c",
        "left_outer_join"                      => "SELECT * FROM A LEFT OUTER JOIN B ON A.c = B.c",

        "natural_join"                         => "SELECT * FROM A NATURAL INNER JOIN B",
        "natural_left_join"                    => "SELECT * FROM A NATURAL LEFT JOIN B",
        "natural_left_outer_join"              => "SELECT * FROM A NATURAL LEFT OUTER JOIN B",

        // PREPARED STATEMENTS WITH NAMED PARAMETER

        "prepared_named_where_greater"             => "SELECT * FROM A WHERE a > :a",

        "prepared_named_where_in_from_subquery"    => "SELECT * FROM A WHERE (SELECT a FROM B) > :c",
        "prepared_named_or_where"                  => "SELECT * FROM A WHERE a > :a OR b = :b",
        "prepared_named_or_multiple_where"         => "SELECT * FROM A WHERE a > :a AND b = :b OR c < :c",
        "prepared_named_or_where_subquery"         => "SELECT * FROM A WHERE (SELECT a FROM B) > :a OR (SELECT a FROM C) = :b",

        "prepared_named_join"                      => "SELECT * FROM A INNER JOIN B ON A.c = :c",
        "prepared_named_join_aliased"              => "SELECT * FROM A AS X INNER JOIN B ON X.c = :c",
        "prepared_named_join_aliased_alternative"  => "SELECT * FROM A INNER JOIN B AS X ON A.c = :c",

        "prepared_named_join_with_and"             => "SELECT * FROM A INNER JOIN B ON A.b = :b AND A.c = :c",
        "prepared_named_join_with_subquery"        => "SELECT * FROM A INNER JOIN (SELECT * FROM B) AS X ON A.b = :b AND A.c = :c",

        "prepared_named_left_join"                 => "SELECT * FROM A LEFT JOIN B ON A.c = :c",
        "prepared_named_left_outer_join"           => "SELECT * FROM A LEFT OUTER JOIN B ON A.c = :c",

        // PREPARED STATEMENTS WITH QUESTION MARKS

        "prepared_where_greater"                => "SELECT * FROM A WHERE a > ?",

        "prepared_where_in_from_subquery"       => "SELECT * FROM A WHERE (SELECT a FROM B) > ?",
        "prepared_or_where"                     => "SELECT * FROM A WHERE a > ? OR b = ?",
        "prepared_or_multiple_where"            => "SELECT * FROM A WHERE a > ? AND b = ? OR c < ?",
        "prepared_or_where_subquery"            => "SELECT * FROM A WHERE (SELECT a FROM B) > ? OR (SELECT a FROM C) = ?",

        "prepared_join"                         => "SELECT * FROM A INNER JOIN B ON A.c = ?",
        "prepared_join_aliased"                 => "SELECT * FROM A AS X INNER JOIN B ON X.c = ?",
        "prepared_join_aliased_alternative"     => "SELECT * FROM A INNER JOIN B AS X ON A.c = ?",

        "prepared_join_with_and"                => "SELECT * FROM A INNER JOIN B ON A.b = ? AND A.c = ?",
        "prepared_join_with_subquery"           => "SELECT * FROM A INNER JOIN (SELECT * FROM B) AS X ON A.b = ? AND A.c = ?",

        "prepared_left_join"                    => "SELECT * FROM A LEFT JOIN B ON A.c = ?",
        "prepared_left_outer_join"              => "SELECT * FROM A LEFT OUTER JOIN B ON A.c = ?",

    ],

    'insert' => [
        "insert_values"             => "INSERT INTO A (a,b,c) VALUES ('x','y','z')",
        "insert_select"             => "INSERT INTO A (a,b,c) SELECT * FROM B",
        "insert_all"                => "INSERT INTO A VALUES ('x','y','z')",

        "insert_or_replace"         => "INSERT OR REPLACE INTO A (a,b,c) VALUES ('x','y','z')",
        "insert_or_rollback"        => "INSERT OR ROLLBACK INTO A (a,b,c) VALUES ('x','y','z')",
        "insert_or_abort"           => "INSERT OR ABORT INTO A (a,b,c) VALUES ('x','y','z')",
        "insert_or_fail"            => "INSERT OR FAIL INTO A (a,b,c) VALUES ('x','y','z')",
        "insert_or_ignore"          => "INSERT OR IGNORE INTO A (a,b,c) VALUES ('x','y','z')",

        "insert_values_prepared"    => "INSERT INTO A (a,b,c) VALUES (:a,:b,:c)",

    ],

    'create' => [

        // tables

        "create_table"                      => "CREATE TABLE IF NOT EXISTS X (a,b)",
        "create_table_using"                => "CREATE TABLE IF NOT EXISTS X AS SELECT * FROM A",
        "create_table_without_id"           => "CREATE TABLE IF NOT EXISTS X (a PRIMARY KEY,b) WITHOUT ROWID",

        // temp

        "create_temp_table"                      => "CREATE TEMPORARY TABLE IF NOT EXISTS X (a,b)",
        "create_temp_table_using"                => "CREATE TEMPORARY TABLE IF NOT EXISTS X AS SELECT * FROM A",
        "create_temp_table_without_id"           => "CREATE TEMPORARY TABLE IF NOT EXISTS X (a PRIMARY KEY,b) WITHOUT ROWID",

        /// triggers

        // delete
        "create_trigger_delete"             => "CREATE TRIGGER IF NOT EXISTS X DELETE ON A BEGIN SELECT * FROM A; END",
        "create_trigger_before_delete"      => "CREATE TRIGGER IF NOT EXISTS X BEFORE DELETE ON A BEGIN SELECT * FROM A; END",
        "create_trigger_after_delete"       => "CREATE TRIGGER IF NOT EXISTS X AFTER DELETE ON A BEGIN SELECT * FROM A; END",
        "create_trigger_insteadof_delete"   => "CREATE TRIGGER IF NOT EXISTS T INSTEAD OF DELETE ON X BEGIN SELECT * FROM A; END",

        "create_trigger_delete_when"             => "CREATE TRIGGER IF NOT EXISTS X DELETE ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_trigger_before_delete_when"      => "CREATE TRIGGER IF NOT EXISTS X BEFORE DELETE ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_trigger_after_delete_when"       => "CREATE TRIGGER IF NOT EXISTS X AFTER DELETE ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_trigger_insteadof_delete_when"   => "CREATE TRIGGER IF NOT EXISTS T INSTEAD OF DELETE ON X WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",

        // temp

        "create_temp_trigger_delete"             => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X DELETE ON A BEGIN SELECT * FROM A; END",
        "create_temp_trigger_before_delete"      => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X BEFORE DELETE ON A BEGIN SELECT * FROM A; END",
        "create_temp_trigger_after_delete"       => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X AFTER DELETE ON A BEGIN SELECT * FROM A; END",
        "create_temp_trigger_insteadof_delete"   => "CREATE TEMPORARY TRIGGER IF NOT EXISTS T INSTEAD OF DELETE ON X BEGIN SELECT * FROM A; END",

        "create_temp_trigger_delete_when"             => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X DELETE ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_temp_trigger_before_delete_when"      => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X BEFORE DELETE ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_temp_trigger_after_delete_when"       => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X AFTER DELETE ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_temp_trigger_insteadof_delete_when"   => "CREATE TEMPORARY TRIGGER IF NOT EXISTS T INSTEAD OF DELETE ON X WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",

        // insert
        "create_trigger_insert"             => "CREATE TRIGGER IF NOT EXISTS X INSERT ON A BEGIN SELECT * FROM A; END",
        "create_trigger_before_insert"      => "CREATE TRIGGER IF NOT EXISTS X BEFORE INSERT ON A BEGIN SELECT * FROM A; END",
        "create_trigger_after_insert"       => "CREATE TRIGGER IF NOT EXISTS X AFTER INSERT ON A BEGIN SELECT * FROM A; END",
        "create_trigger_insteadof_insert"   => "CREATE TRIGGER IF NOT EXISTS T INSTEAD OF INSERT ON X BEGIN SELECT * FROM A; END",

        "create_trigger_insert_when"             => "CREATE TRIGGER IF NOT EXISTS X INSERT ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_trigger_before_insert_when"      => "CREATE TRIGGER IF NOT EXISTS X BEFORE INSERT ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_trigger_after_insert_when"       => "CREATE TRIGGER IF NOT EXISTS X AFTER INSERT ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_trigger_insteadof_insert_when"   => "CREATE TRIGGER IF NOT EXISTS T INSTEAD OF INSERT ON X WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",

        // temp

        "create_temp_trigger_insert"             => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X INSERT ON A BEGIN SELECT * FROM A; END",
        "create_temp_trigger_before_insert"      => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X BEFORE INSERT ON A BEGIN SELECT * FROM A; END",
        "create_temp_trigger_after_insert"       => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X AFTER INSERT ON A BEGIN SELECT * FROM A; END",
        "create_temp_trigger_insteadof_insert"   => "CREATE TEMPORARY TRIGGER IF NOT EXISTS T INSTEAD OF INSERT ON X BEGIN SELECT * FROM A; END",

        "create_temp_trigger_insert_when"             => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X INSERT ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_temp_trigger_before_insert_when"      => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X BEFORE INSERT ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_temp_trigger_after_insert_when"       => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X AFTER INSERT ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_temp_trigger_insteadof_insert_when"   => "CREATE TEMPORARY TRIGGER IF NOT EXISTS T INSTEAD OF INSERT ON X WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",

        // update

        "create_trigger_update"             => "CREATE TRIGGER IF NOT EXISTS X UPDATE ON A BEGIN SELECT * FROM A; END",
        "create_trigger_before_update"      => "CREATE TRIGGER IF NOT EXISTS X BEFORE UPDATE ON A BEGIN SELECT * FROM A; END",
        "create_trigger_after_update"       => "CREATE TRIGGER IF NOT EXISTS X AFTER UPDATE ON A BEGIN SELECT * FROM A; END",
        "create_trigger_insteadof_update"   => "CREATE TRIGGER IF NOT EXISTS T INSTEAD OF UPDATE ON X BEGIN SELECT * FROM A; END",

        "create_trigger_update_when"             => "CREATE TRIGGER IF NOT EXISTS X UPDATE ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_trigger_before_update_when"      => "CREATE TRIGGER IF NOT EXISTS X BEFORE UPDATE ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_trigger_after_update_when"       => "CREATE TRIGGER IF NOT EXISTS X AFTER UPDATE ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_trigger_insteadof_update_when"   => "CREATE TRIGGER IF NOT EXISTS T INSTEAD OF UPDATE ON X WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",

        "create_trigger_update_of"             => "CREATE TRIGGER IF NOT EXISTS X UPDATE OF a,b ON A BEGIN SELECT * FROM A; END",
        "create_trigger_before_update_of"      => "CREATE TRIGGER IF NOT EXISTS X BEFORE UPDATE OF a,b ON A BEGIN SELECT * FROM A; END",
        "create_trigger_after_update_of"       => "CREATE TRIGGER IF NOT EXISTS X AFTER UPDATE OF a,b ON A BEGIN SELECT * FROM A; END",
        "create_trigger_insteadof_update_of"   => "CREATE TRIGGER IF NOT EXISTS T INSTEAD OF UPDATE OF a,b ON X BEGIN SELECT * FROM A; END",

        "create_trigger_update_of_when"             => "CREATE TRIGGER IF NOT EXISTS X UPDATE OF a,b ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_trigger_before_update_of_when"      => "CREATE TRIGGER IF NOT EXISTS X BEFORE UPDATE OF a,b ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_trigger_after_update_of_when"       => "CREATE TRIGGER IF NOT EXISTS X AFTER UPDATE OF a,b ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_trigger_insteadof_update_of_when"   => "CREATE TRIGGER IF NOT EXISTS T INSTEAD OF UPDATE OF a,b ON X WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",

        // temp

        "create_temp_trigger_update"             => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X UPDATE ON A BEGIN SELECT * FROM A; END",
        "create_temp_trigger_before_update"      => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X BEFORE UPDATE ON A BEGIN SELECT * FROM A; END",
        "create_temp_trigger_after_update"       => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X AFTER UPDATE ON A BEGIN SELECT * FROM A; END",
        "create_temp_trigger_insteadof_update"   => "CREATE TEMPORARY TRIGGER IF NOT EXISTS T INSTEAD OF UPDATE ON X BEGIN SELECT * FROM A; END",

        "create_temp_trigger_update_when"             => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X UPDATE ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_temp_trigger_before_update_when"      => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X BEFORE UPDATE ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_temp_trigger_after_update_when"       => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X AFTER UPDATE ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_temp_trigger_insteadof_update_when"   => "CREATE TEMPORARY TRIGGER IF NOT EXISTS T INSTEAD OF UPDATE ON X WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",

        "create_temp_trigger_update_of"             => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X UPDATE OF a,b ON A BEGIN SELECT * FROM A; END",
        "create_temp_trigger_before_update_of"      => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X BEFORE UPDATE OF a,b ON A BEGIN SELECT * FROM A; END",
        "create_temp_trigger_after_update_of"       => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X AFTER UPDATE OF a,b ON A BEGIN SELECT * FROM A; END",
        "create_temp_trigger_insteadof_update_of"   => "CREATE TEMPORARY TRIGGER IF NOT EXISTS T INSTEAD OF UPDATE OF a,b ON X BEGIN SELECT * FROM A; END",

        "create_temp_trigger_update_of_when"             => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X UPDATE OF a,b ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_temp_trigger_before_update_of_when"      => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X BEFORE UPDATE OF a,b ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_temp_trigger_after_update_of_when"       => "CREATE TEMPORARY TRIGGER IF NOT EXISTS X AFTER UPDATE OF a,b ON A WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",
        "create_temp_trigger_insteadof_update_of_when"   => "CREATE TEMPORARY TRIGGER IF NOT EXISTS T INSTEAD OF UPDATE OF a,b ON X WHEN a = 0 OR b > 0 BEGIN SELECT * FROM A; END",

        // indexes

        "create_index"              => "CREATE INDEX IF NOT EXISTS I ON A (a,b)",
        "create_unique_index"       => "CREATE UNIQUE INDEX IF NOT EXISTS I ON A (a,b)",
        "create_index_where"        => "CREATE INDEX IF NOT EXISTS I ON A (a,b) WHERE a = 0",
        "create_unique_index_where" => "CREATE UNIQUE INDEX IF NOT EXISTS I ON A (a,b) WHERE a = 0",

        // views

        "create_view"              => "CREATE VIEW IF NOT EXISTS V AS SELECT * FROM A",
        "create_temporary_view"    => "CREATE TEMPORARY VIEW IF NOT EXISTS V AS SELECT * FROM A",

    ],

    "delete" => [
        "delete"            => "DELETE FROM A",
        "delete_where"      => "DELETE FROM A WHERE a > 0",
    ],

    "update" => [

        "update"                => "UPDATE A SET a = 'a'",
        "update_where"          => "UPDATE A SET a = 'a' WHERE c = 0",
        "update_many"           => "UPDATE A SET a = 'a',b = 'b'",
        "update_many_where"     => "UPDATE A SET a = 'a',b = 'b' WHERE c = 0",

        "prepared_update"                => "UPDATE A SET a = :a",
        "prepared_update_where"          => "UPDATE A SET a = :a WHERE c = :c",
        "prepared_update_many"           => "UPDATE A SET a = :a,b = :b",
        "prepared_update_many_where"     => "UPDATE A SET a = :a,b = :b WHERE c = :c",

        "update_or_replace"                 => "UPDATE OR REPLACE A SET a = 'a'",
        "update_or_ignore"                  => "UPDATE OR IGNORE A SET a = 'a'",
        "update_or_abort"                   => "UPDATE OR ABORT A SET a = 'a'",
        "update_or_fail"                    => "UPDATE OR FAIL A SET a = 'a'",
        "update_or_rollback"                => "UPDATE OR ROLLBACK A SET a = 'a'",
    ],

    "drop" => [

        "drop_table"     => "DROP TABLE IF EXISTS A",
        "drop_index"     => "DROP INDEX IF EXISTS A",
        "drop_trigger"   => "DROP TRIGGER IF EXISTS A",
        "drop_view"      => "DROP VIEW IF EXISTS X",

    ],

    "alter" => [

        "add"       => "ALTER TABLE A ADD COLUMN z",
        "rename"    => "ALTER TABLE A RENAME TO Z",
    ],

    "pragma" => [

        "pragma"            => "PRAGMA x = y",
        "pragma_key_only"   => "PRAGMA x",

    ]

];
