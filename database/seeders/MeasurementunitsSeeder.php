<?php

namespace Database\Seeders;

use App\Models\Measurementunits;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeasurementunitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Measurementunits::create([
            'name' =>'PAQUETE',
            'abbr' =>'PQT'
        ]);
        Measurementunits::create([
            'name' =>'TUBO',
            'abbr' =>'TBO'
        ]);
        Measurementunits::create([
            'name' =>'METROS',
            'abbr' =>'MTS'
        ]);
        Measurementunits::create([
            'name' =>'JUEGO',
            'abbr' =>'JGO'
        ]);
        Measurementunits::create([
            'name' =>'TRAMO',
            'abbr' =>'TMO'
        ]);
        Measurementunits::create([
            'name' =>'BOTE',
            'abbr' =>'BTE'
        ]);
        Measurementunits::create([
            'name' =>'KILOGRAMO',
            'abbr' =>'KGR'
        ]);
        Measurementunits::create([
            'name' =>'CAJA',
            'abbr' =>'CJA'
        ]);
        Measurementunits::create([
            'name' =>'BOLSA',
            'abbr' =>'BSA'
        ]);
        Measurementunits::create([
            'name' =>'LITROS',
            'abbr' =>'LTS'
        ]);
        Measurementunits::create([
            'name' =>'ROLLO',
            'abbr' =>'RLO'
        ]);
        Measurementunits::create([
            'name' =>'TRAMO',
            'abbr' =>'TRM'
        ]);
        Measurementunits::create([
            'name' =>'CUÑETE',
            'abbr' =>'CUÑT'
        ]);
        Measurementunits::create([
            'name' =>'KIT',
            'abbr' =>'KIT'
        ]);
        Measurementunits::create([
            'name' =>'CUBETA',
            'abbr' =>'CTA'
        ]);
        Measurementunits::create([
            'name' =>'PIEZA',
            'abbr' =>'PZA'
        ]);
    }
}
