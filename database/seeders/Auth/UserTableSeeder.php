<?php

namespace Database\Seeders\Auth;

use App\Events\Backend\UserCreated;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $users = [
            [
                'id' => 1,
                'username' => '100001',
                'name' => 'Super Admin',
                'email' => 'super@admin.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'username' => '100002',
                'name' => 'Admin Istrator',
                'email' => 'admin@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'username' => '100003',
                'name' => 'Manager 1',
                'email' => 'manager-1@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'username' => '100004',
                'name' => 'Executive User',
                'email' => 'executive@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'username' => '100005',
                'name' => 'Resident 1',
                'email' => 'resident-1@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 6,
                'username' => '100006',
                'name' => 'Resident 2',
                'email' => 'resident-2@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 7,
                'username' => '100007',
                'name' => 'Resident 3',
                'email' => 'resident-3@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'id' => 8,
                'username' => '100008',
                'name' => 'Resident 4',
                'email' => 'resident-4@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'id' => 9,
                'username' => '100009',
                'name' => 'Resident 5',
                'email' => 'resident-5@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'id' => 10,
                'username' => '100010',
                'name' => 'Security Guard 1',
                'email' => 'security-1@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'id' => 11,
                'username' => '100011',
                'name' => 'Security Guard 2',
                'email' => 'security-2@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'id' => 12,
                'username' => '100012',
                'name' => 'Security Guard 3',
                'email' => 'security-3@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'id' => 13,
                'username' => '100013',
                'name' => 'Security Guard 4',
                'email' => 'security-4@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'id' => 14,
                'username' => '100014',
                'name' => 'Security Guard 5',
                'email' => 'security-5@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'id' => 15,
                'username' => '100015',
                'name' => 'Manager 2',
                'email' => 'manager-2@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'id' => 16,
                'username' => '100016',
                'name' => 'Manager 3',
                'email' => 'manager-3@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'id' => 17,
                'username' => '100017',
                'name' => 'Manager 4',
                'email' => 'manager-4@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'id' => 18,
                'username' => '100018',
                'name' => 'Manager 5',
                'email' => 'manager-5@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'id' => 19,
                'username' => '100019',
                'name' => 'Service Staff 1',
                'email' => 'service-staff-1@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'id' => 20,
                'username' => '100020',
                'name' => 'Service Staff 2',
                'email' => 'service-staff-2@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'id' => 21,
                'username' => '100021',
                'name' => 'Service Staff 3',
                'email' => 'service-staff-3@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'id' => 22,
                'username' => '100022',
                'name' => 'Service Staff 4',
                'email' => 'service-staff-4@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'id' => 23,
                'username' => '100023',
                'name' => 'Service Staff 5',
                'email' => 'service-staff-5@yopmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($users as $user_data) {
            $user = User::create($user_data);

            event(new UserCreated($user));
        }
    }
}
