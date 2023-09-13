<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'SuperUser']);
        $role2 = Role::create(['name' => 'SubGerente']);

        $role3 = Role::create(['name' => 'JefeMateriales']);
        $role4 = Role::create(['name' => 'Almcenista']);
        $role5 = Role::create(['name' => 'Capturista']);
        $role6 = Role::create(['name' => 'Usuarios']);
    }
}
