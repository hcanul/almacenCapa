<?php

namespace Database\Seeders;

use App\Models\Boss;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BossSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Boss::create([
            'name' => 'C.P. SATURNINO DE JESÚS CANUL DZUL',
            'job_id' => 1,
            'workarea_id' => 1,
        ]);
        Boss::create([
            'name' => 'C. PASCUAL MARTINEZ GAMEZ',
            'job_id' => 2,
            'workarea_id' => 2,
        ]);
        Boss::create([
            'name' => 'LIC. HENRY DAVID AMAYA BRICEÑO',
            'job_id' => 2,
            'workarea_id' => 3,
        ]);
        Boss::create([
            'name' => 'ING. CARLOS RICARDO VEGA VEGA',
            'job_id' => 2,
            'workarea_id' => 4,
        ]);
    }
}
