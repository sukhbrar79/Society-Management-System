<?php

namespace Modules\Parking\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Parking\Models\Parking;
use Modules\Parking\Models\ParkingAllocation;
use Modules\Parking\Models\ParkingRequest;

class ParkingDatabaseSeeder extends Seeder
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
         * Parkings Seed
         * ------------------
         */

        // DB::table('parkings')->truncate();
        // echo "Truncate: parkings \n";

        Parking::factory()->count(20)->create();
        $rows = Parking::all();
        echo " Insert: parkings \n\n";

        ParkingAllocation::factory()->count(20)->create();
        $rows = ParkingAllocation::all();
        echo " Insert: parkings \n\n";

        ParkingRequest::factory()->count(20)->create();
        $rows = ParkingRequest::all();
        echo " Insert: parkings \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
