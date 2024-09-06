<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class Roles_permissinons extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //

        // $roles = ['admin', 'user', 'viewer'];

        // foreach ($roles as $roleName) {
        //     Role::create(['name' => $roleName]);
        // }

        // $viewerPermissions = ['View_Published_Posts','View_Comments'];
        // $userPermissions = ['Create_Posts', 'Edit_Own_Posts', 'Delete_Own_Posts','View_All_Posts','Add_Comments','Edit_Own_Comments','Delete_Own_Comments'];
        // $adminPermissions = ['Create_Posts', 'Edit_Any_Post', 'Delete_Any_Post','View_All_Posts','Add_Comments','Edit_Any_Comment','Delete_Any_Comment','Manage_Users'];

        // $allPermissions = array_merge($viewerPermissions, $userPermissions, $adminPermissions);

        // // Remove duplicate permissions
        // $uniquePermissions = array_unique($allPermissions);

        // // Optional: Reindex array (if you want to reindex the array numerically)
        // $uniquePermissions = array_values($uniquePermissions);

        // foreach ($uniquePermissions as $permissionName) {
        //     Permission::create(['name' => $permissionName]);
        // }


        // $role = Role::findByName('viewer');
        // $role->givePermissionTo($viewerPermissions);

        // $role = Role::findByName('admin');
        // $role->givePermissionTo($adminPermissions);

        // $role = Role::findByName('user');
        // $role->givePermissionTo($userPermissions);

        //  User::find(42)->assignRole('user');
    //




    }
}
