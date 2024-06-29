<?php

namespace Database\Seeders;

use Database\Seeders\Auth\PermissionRoleTableSeeder;
use Database\Seeders\Auth\UserRoleTableSeeder;
use Database\Seeders\Auth\UserTableSeeder;
use Modules\Block\database\seeders\BlockDatabaseSeeder;
use Modules\Flat\database\seeders\FlatDatabaseSeeder;
use Modules\Complaint\database\seeders\ComplaintDatabaseSeeder;
use Modules\Visitor\database\seeders\VisitorDatabaseSeeder;
use Modules\Parking\database\seeders\ParkingDatabaseSeeder;

use Illuminate\Database\Seeder;

/**
 * Class AuthTableSeeder.
 */
class AuthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        echo "\n Default Users Created. \n";
        $this->call(PermissionRoleTableSeeder::class);
        echo "\n Default Permissions Created. \n";
        $this->call(UserRoleTableSeeder::class);
        echo "\n Default Roles created and assigned to Users. \n";
        $this->call(BlockDatabaseSeeder::class);
        $this->call(FlatDatabaseSeeder::class);
        $this->call(ComplaintDatabaseSeeder::class);
        $this->call(VisitorDatabaseSeeder::class);
        $this->call(ParkingDatabaseSeeder::class);

    }
}
