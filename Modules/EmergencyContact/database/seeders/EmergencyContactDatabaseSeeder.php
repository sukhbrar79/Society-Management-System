<?php

namespace Modules\EmergencyContact\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\EmergencyContact\Models\EmergencyContact;

class EmergencyContactDatabaseSeeder extends Seeder
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
         * EmergencyContacts Seed
         * ------------------
         */

        // DB::table('emergencycontacts')->truncate();
        // echo "Truncate: emergencycontacts \n";

        EmergencyContact::factory()->count(20)->create();
        $rows = EmergencyContact::all();
        echo " Insert: emergencycontacts \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
