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
        Job::create(['name'=>'GERENTE']);
        Job::create(['name'=>'SUBGERENTE']);
        Job::create(['name'=>'JEFE DE DEPARTAMENTO']);
        Job::create(['name'=>'JEFE DE AREA I']);
        Job::create(['name'=>'JEFE DE AREA II']);
        Job::create(['name'=>'ENCARGADO']);
    }
}
