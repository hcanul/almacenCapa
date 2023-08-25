<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Job::create(['name'=>'Gerente']);
        Job::create(['name'=>'Subgerente']);
        Job::create(['name'=>'Jefe de Departamento']);
        Job::create(['name'=>'Jefe de Area I']);
        Job::create(['name'=>'Jefe de Area II']);
    }
}
