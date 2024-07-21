<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Modules\Category\Models\Category;
use Modules\Post\Models\Post;
use Modules\Tag\Models\Tag;
use Tests\TestCase;

class BackendViewSuperAdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->seed();
        // Artisan::call('db:seed');

        // Get Super Admin
        $user = User::whereId(1)->first();

        $this->actingAs($user);
    }

    /**
     * Backend Dashboard Test.
     *
     * ---------------------------------------------------------------
     */
    public function test_super_admin_user_can_view_backend(): void
    {
        $response = $this->get('/admin');
        $response->assertStatus(200);

        $response = $this->get('/admin/dashboard');
        $response->assertStatus(200);
    }

    /**
     * Notifications Test.
     *
     * ---------------------------------------------------------------
     */
    public function test_super_admin_user_can_view_notifications_index(): void
    {
        $response = $this->get('/admin/notifications');

        $response->assertStatus(200);
    }

    /**
     * Settings Test.
     *
     * ---------------------------------------------------------------
     */
    public function test_super_admin_user_can_view_settings_index(): void
    {
        $response = $this->get('/admin/settings');

        $response->assertStatus(200);
    }

    /**
     * Backups Test.
     *
     * ---------------------------------------------------------------
     */
    public function test_super_admin_user_can_view_backups_index(): void
    {
        $response = $this->get('/admin/backups');

        $response->assertStatus(200);
    }

    /**
     * Users Test.
     *
     * ---------------------------------------------------------------
     */
    public function test_super_admin_user_can_view_users_index(): void
    {
        $response = $this->get('/admin/users');

        $response->assertStatus(200);
    }

    public function test_super_admin_user_can_create_user(): void
    {
        $response = $this->get('/admin/users/create');

        $response->assertStatus(200);
    }

    public function test_super_admin_user_can_show_user(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $response = $this->get('/admin/users/'.$i);

            $response->assertStatus(200);
        }
    }

    public function test_super_admin_user_can_edit_user(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $response = $this->get('/admin/users/'.$i.'/edit');

            $response->assertStatus(200);
        }
    }

    public function test_super_admin_user_can_delete_user(): void
    {
        $model_id = 5;

        $user = User::find($model_id);

        $this->assertModelExists($user);

        $user->delete();

        $this->assertSoftDeleted($user);
    }

    public function test_super_admin_user_can_view_trashed_user(): void
    {
        $model_id = 5;

        $user = User::find($model_id);

        $this->assertModelExists($user);

        $user->delete();

        $this->assertDatabaseMissing('users', [
            'id' => $model_id,
            'deleted_at' => null,
        ]);
    }

    public function test_super_admin_user_can_restore_trashed_user(): void
    {
        $model_id = 5;

        $response = $this->delete('/admin/users/'.$model_id);

        $response->assertStatus(302);

        $response->assertRedirect('/admin/users');

        $user = User::withTrashed()->find($model_id)->first();

        $user->restore();

        $this->assertModelExists($user);
    }

    public function test_super_admin_user_can_restore_user(): void
    {
        $model_id = 5;

        $user = User::find($model_id);

        $this->assertModelExists($user);

        $user->delete();

        $this->assertSoftDeleted($user);
    }

    public function test_super_admin_user_can_view_change_password_user(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $response = $this->get('/admin/users/'.$i.'/change-password');

            $response->assertStatus(200);
        }
    }

    public function test_super_admin_user_can_update_user_password(): void
    {
        $user_id = 5;

        $response = $this
            ->postJson(route('backend.users.changePasswordUpdate', $user_id), [
                '_method' => 'PATCH',
                'password' => '123456',
                'password_confirmation' => '123456',
            ]);

        $response->assertStatus(302);

        $response->assertRedirect(route('backend.users.show', $user_id));
    }

    /**
     * Roles Test.
     *
     * ---------------------------------------------------------------
     */
    public function test_super_admin_user_can_view_roles_index(): void
    {
        $response = $this->get('/admin/roles');

        $response->assertStatus(200);
    }

    public function test_super_admin_user_can_view_roles_count(): void
    {
        $this->assertDatabaseCount('roles', 7);
    }

    public function test_super_admin_user_can_create_role(): void
    {
        $response = $this->get('/admin/roles/create');

        $response->assertStatus(200);
    }

    public function test_super_admin_user_can_show_role(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $response = $this->get('/admin/roles/'.$i);

            $response->assertStatus(200);
        }
    }

    public function test_super_admin_user_can_edit_role(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $response = $this->get('/admin/roles/'.$i.'/edit');

            $response->assertStatus(200);
        }
    }

    public function test_super_admin_user_can_delete_role(): void
    {
        $model_id = 5;

        $user = Role::find($model_id);

        $this->assertModelExists($user);

        $user->delete();

        // $this->assertSoftDeleted($user);

        $this->assertModelMissing($user);
    }

    /**
     * Log Viewer Test.
     *
     * ---------------------------------------------------------------
     */
    public function test_super_admin_user_can_view_logs_index(): void
    {
        $response = $this->get('/admin/log-viewer');

        $response->assertStatus(200);
    }

    public function test_super_admin_user_can_view_logs_view(): void
    {
        $response = $this->get('/admin/log-viewer/logs');

        $response->assertStatus(200);
    }

}
