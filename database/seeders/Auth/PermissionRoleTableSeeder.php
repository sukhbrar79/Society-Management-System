<?php

namespace Database\Seeders\Auth;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->CreateDefaultPermissions();

        /**
         * Create Roles and Assign Permissions to Roles.
         */
        $super_admin = Role::create(['id' => '1', 'name' => 'super admin']);

        $admin = Role::create(['id' => '2', 'name' => 'administrator']);
        $admin->givePermissionTo(['view_backend', 'edit_settings']);

        $manager = Role::create(['id' => '3', 'name' => 'manager']);
        
        $modulesPath = base_path('Modules');
        $moduleDirectories = File::directories($modulesPath);

        foreach ($moduleDirectories as $moduleDirectory) {
            $moduleName = basename($moduleDirectory);
            $moduleName = Str::lower(Str::plural($moduleName));

            $manager->givePermissionTo('add_'.$moduleName);
            $manager->givePermissionTo('edit_'.$moduleName);
            $manager->givePermissionTo('view_'.$moduleName);
            $manager->givePermissionTo('delete_'.$moduleName);
            $manager->givePermissionTo('restore_'.$moduleName);
        }
        $manager->givePermissionTo(['view_backend', 'view_circles','view_residents']);

        $executive = Role::create(['id' => '4', 'name' => 'executive']);
        $executive->givePermissionTo('view_backend');

        $user = Role::create(['id' => '5', 'name' => 'resident']);
        $user = Role::create(['id' => '6', 'name' => 'security-guard']);
        $user->givePermissionTo('view_backend');
        $user->givePermissionTo('add_visitors');
        $user->givePermissionTo('edit_visitors');
        $user->givePermissionTo('view_visitors');
        $user->givePermissionTo('delete_visitors');
        $user->givePermissionTo('restore_visitors');
        $user->givePermissionTo(['view_backend', 'view_circles']);

        $user = Role::create(['id' => '7', 'name' => 'service-staff']);
        $user->givePermissionTo('view_backend');
        $user->givePermissionTo('edit_complaints');
        $user->givePermissionTo('view_complaints');
        $user->givePermissionTo(['view_backend', 'view_circles']);


    }

    public function CreateDefaultPermissions()
    {
        // Create Permissions
        $permissions = Permission::defaultPermissions();

        foreach ($permissions as $permission) {
            $permission = Permission::make(['name' => $permission]);
            $permission->saveOrFail();
        }

        $modulesPath = base_path('Modules');
        $moduleDirectories = File::directories($modulesPath);

        foreach ($moduleDirectories as $moduleDirectory) {
            $moduleName = basename($moduleDirectory);
            $moduleName = Str::lower(Str::plural($moduleName));
            
            Artisan::call('auth:permissions', [
                'name' => $moduleName,
            ]);
            
        }

       
    }
}
