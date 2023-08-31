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
        Workarea::create(['name'=> 'ORGANISMO OPERADOR']);
        Workarea::create(['name'=> 'ADMINISTRATIVO']);
        Workarea::create(['name'=> 'COMERCIAL']);
        Workarea::create(['name'=> 'TÉCNICO']);
        Workarea::create(['name'=> 'INFORMÁTICA']);
        Workarea::create(['name'=> 'RECURSOS MATERIALES']);
        Workarea::create(['name'=> 'RECURSOS HUMANOS']);
        Workarea::create(['name'=> 'RECURSOS FINANCIEROS']);
        Workarea::create(['name'=> 'OPERACIÓN']);
        Workarea::create(['name'=> 'RECUPEERACIOÓN DE PERDIDAS']);
        Workarea::create(['name'=> 'ATENCIÓN USUARIOS']);
        Workarea::create(['name'=> 'PADRON']);
        Workarea::create(['name'=> 'ALMACÉN']);
    }
}
