<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SqlFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $file=database_path("country.sql");
        $sql = file_get_contents($file);
        DB::unprepared($sql);

        $file=database_path("countries.sql");
        $sql = file_get_contents($file);
        DB::unprepared($sql);

        $file=database_path("currency.sql");
        $sql = file_get_contents($file);
        DB::unprepared($sql);
    }
}
