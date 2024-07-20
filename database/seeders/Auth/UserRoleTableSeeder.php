<?php

namespace Database\Seeders\Auth;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

/**
 * Class UserRoleTableSeeder.
 */
class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        User::findOrFail(1)->assignRole('super admin');
        User::findOrFail(2)->assignRole('administrator');
        User::findOrFail(3)->assignRole('manager');
        User::findOrFail(4)->assignRole('executive');
        User::findOrFail(5)->assignRole('resident');
        User::findOrFail(6)->assignRole('resident');
        User::findOrFail(7)->assignRole('resident');
        User::findOrFail(8)->assignRole('resident');
        User::findOrFail(9)->assignRole('resident');
        User::findOrFail(10)->assignRole('security-guard');
        User::findOrFail(11)->assignRole('security-guard');
        User::findOrFail(12)->assignRole('security-guard');
        User::findOrFail(13)->assignRole('security-guard');
        User::findOrFail(14)->assignRole('security-guard');
        User::findOrFail(15)->assignRole('manager');
        User::findOrFail(16)->assignRole('manager');
        User::findOrFail(17)->assignRole('manager');
        User::findOrFail(18)->assignRole('manager');
        User::findOrFail(19)->assignRole('service-staff');
        User::findOrFail(20)->assignRole('service-staff');
        User::findOrFail(21)->assignRole('service-staff');
        User::findOrFail(22)->assignRole('service-staff');
        User::findOrFail(23)->assignRole('service-staff');



        Artisan::call('cache:clear');
    }
}
