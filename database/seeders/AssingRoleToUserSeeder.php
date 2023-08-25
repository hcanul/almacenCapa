<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AssingRoleToUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permiso  = Permission::create(['name' => 'Create']);
        $permiso1 = Permission::create(['name' => 'Read']);
        $permiso2 = Permission::create(['name' => 'Update']);
        $permiso3 = Permission::create(['name' => 'Delete']);
        $permiso4 = Permission::create(['name' => 'Edit']);
        $permiso5 = Permission::create(['name' => 'All']);

        $role = Role::where('name', 'SuperUser')->first();
        $permissions = Permission::pluck('id')->toArray();
        $role->givePermissionTo([$permiso, $permiso1, $permiso2, $permiso3, $permiso4, $permiso5]);
        $user = User::find(1)->assignRole($role);
    }
}
