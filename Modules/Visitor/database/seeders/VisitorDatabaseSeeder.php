<?php

namespace Modules\Visitor\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Visitor\Models\Visitor;

class VisitorDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        /*
         * Visitors Seed
         * ------------------
         */

        // DB::table('visitors')->truncate();
        // echo "Truncate: visitors \n";

        Visitor::factory()->count(20)->create();
        $rows = Visitor::all();
        echo " Insert: visitors \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
