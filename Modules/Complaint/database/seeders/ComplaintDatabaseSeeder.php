<?php

namespace Modules\Complaint\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Complaint\Models\Complaint;

class ComplaintDatabaseSeeder extends Seeder
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
         * Complaints Seed
         * ------------------
         */

        // DB::table('complaints')->truncate();
        // echo "Truncate: complaints \n";

        Complaint::factory()->count(20)->create();
        $rows = Complaint::all();
        echo " Insert: complaints \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
