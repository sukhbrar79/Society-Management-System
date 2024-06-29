<?php

namespace Modules\Block\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Block\Models\Block;

class BlockDatabaseSeeder extends Seeder
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
         * Blocks Seed
         * ------------------
         */

        // DB::table('blocks')->truncate();
        // echo "Truncate: blocks \n";

        Block::factory()->count(5)->create();
        $rows = Block::all();
        echo " Insert: blocks \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
