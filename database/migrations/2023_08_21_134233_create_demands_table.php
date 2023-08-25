<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('demands', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->float('total');
            $table->enum('pfstatus', ['Pendiente', 'Aprobado', 'MatIns', 'Cancelado'])->default('Pendiente');
            $table->enum('sfstatus', ['Pendiente', 'Aprobado', 'MatIns', 'Cancelado'])->default('Pendiente');
            $table->enum('status', ['Pendiente', 'Aprobado', 'MatIns', 'Cancelado'])->default('Pendiente');
            $table->text('obserMat');
            $table->text('obserSub');
            $table->text('actividad');
            $table->integer('boss_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demands');
    }
};
