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
        Schema::create('detsols', function (Blueprint $table) {
            $table->id();
            $table->integer('demand_id');
            $table->integer('inventory_id');
            $table->float('cantidad');
            $table->float('costo');
            $table->float('total');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detsols');
    }
};
