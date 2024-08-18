<?php

namespace Modules\Guideline\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Guideline\Models\Guideline;

class GuidelineDatabaseSeeder extends Seeder
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
         * Guidelines Seed
         * ------------------
         */

        // DB::table('guidelines')->truncate();
        // echo "Truncate: guidelines \n";

        Guideline::factory()->count(20)->create();
        $rows = Guideline::all();
        echo " Insert: guidelines \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
