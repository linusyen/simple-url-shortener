<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function createMysqlTable()
    {
        $sql = file_get_contents(__DIR__ . '/testdata.sql');
        foreach (explode(";", $sql) as $statement) {
            DB::statement($statement);
        }
    }
}
