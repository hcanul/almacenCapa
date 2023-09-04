<?php

namespace Database\Seeders;

use App\Models\DepartamentBoss;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentBossSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DepartamentBoss::create([
            'name' => 'C. HUGO PAULINO CANUL ECHAZARRETA',
            'job_id' => 3,
            'workarea_id' => 5,
            'boss_id' =>2,
        ]);
        DepartamentBoss::create([
            'name' => 'C. MERLE IRAMA NOVELO VELA',
            'job_id' => 3,
            'workarea_id' => 6,
            'boss_id' =>2,
        ]);
        DepartamentBoss::create([
            'name' => 'TSUI. RITA YANET MARTIN VAZQUEZ',
            'job_id' => 3,
            'workarea_id' => 7,
            'boss_id' =>2,
        ]);
        DepartamentBoss::create([
            'name' => 'C. ROSA MARIA POOT PUC',
            'job_id' => 3,
            'workarea_id' => 8,
            'boss_id' =>2,
        ]);
        DepartamentBoss::create([
            'name' => 'C. MAYRA ARELI NOVELO VELA',
            'job_id' => 3,
            'workarea_id' => 9,
            'boss_id' =>4,
        ]);
        DepartamentBoss::create([
            'name' => 'ING. IDELFONSO CAHUICH JIMENEZ',
            'job_id' => 3,
            'workarea_id' => 10,
            'boss_id' =>4,
        ]);
        DepartamentBoss::create([
            'name' => 'LIC. JOSE ANGELLO CIMA AKE',
            'job_id' => 3,
            'workarea_id' => 11,
            'boss_id' =>3,
        ]);
        DepartamentBoss::create([
            'name' => 'LIC. LORENA FRANCISCA LOPEZ LANDEROS',
            'job_id' => 3,
            'workarea_id' => 12,
            'boss_id' =>3,
        ]);
        DepartamentBoss::create([
            'name' => 'C. MAURA DEL CARMEN ARCEO SANCHEZ',
            'job_id' => 6,
            'workarea_id' => 13,
            'boss_id' =>2,
        ]);
    }
}
