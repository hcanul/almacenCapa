<?php

namespace Database\Seeders;

use App\Models\Workarea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkareaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Workarea::create(['name'=> 'Organismo Operador']);
        Workarea::create(['name'=> 'Administrativa']);
        Workarea::create(['name'=> 'Comercial']);
        Workarea::create(['name'=> 'Técnica']);
        Workarea::create(['name'=> 'Informática']);
        Workarea::create(['name'=> 'Recursos Materiales']);
        Workarea::create(['name'=> 'Recursos Humanos']);
        Workarea::create(['name'=> 'Recursos Financieros']);
        Workarea::create(['name'=> 'Operación']);
        Workarea::create(['name'=> 'Recuperación de Perdidas']);
        Workarea::create(['name'=> 'Atención Usuarios']);
        Workarea::create(['name'=> 'Padron']);
    }
}
