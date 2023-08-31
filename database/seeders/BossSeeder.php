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
        Boss::create([
            'name' => 'C. HUGO PAULINO CANUL ECHAZARRETA',
            'job_id' => 3,
            'workarea_id' => 5,
        ]);
        Boss::create([
            'name' => 'C. MERLE IRAMA NOVELO VELA',
            'job_id' => 3,
            'workarea_id' => 6,
        ]);
        Boss::create([
            'name' => 'TSUI. RITA YANET MARTIN VAZQUEZ',
            'job_id' => 3,
            'workarea_id' => 7,
        ]);
        Boss::create([
            'name' => 'C. ROSA MARIA POOT PUC',
            'job_id' => 3,
            'workarea_id' => 8,
        ]);
        Boss::create([
            'name' => 'C. MAYRA ARELI NOVELO VELA',
            'job_id' => 3,
            'workarea_id' => 9,
        ]);
        Boss::create([
            'name' => 'ING. IDELFONSO CAHUICH JIMENEZ',
            'job_id' => 3,
            'workarea_id' => 10,
        ]);
        Boss::create([
            'name' => 'LIC. JOSE ANGELLO CIMA AKE',
            'job_id' => 3,
            'workarea_id' => 11,
        ]);
        Boss::create([
            'name' => 'LIC. LORENA FRANCISCA LOPEZ LANDEROS',
            'job_id' => 3,
            'workarea_id' => 12,
        ]);
        Boss::create([
            'name' => 'C. MAURA DEL CARMEN ARCEO SANCHEZ',
            'job_id' => 6,
            'workarea_id' => 13,
        ]);
    }
}
