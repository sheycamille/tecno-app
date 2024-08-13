<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

     private $permissions = [
        'role-list',
        'role-create',
        'role-edit',
        'role-delete',
        'user-list',
        'user-create',
        'user-edit',
        'user-delete',
        'thesis-create',
        'thesis-edit',
        'thesis-delete',
        'thesis-list',
        
    ];
    public function run(): void
    {
        // User::factory(10)->create();
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Super admin.
        $user = User::create([
            'name' => 'Test admin',
            'email' => 'test.admin@gmail.com',
            'password' => Hash::make('password')
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
