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
        Schema::create('warehouse_products', function (Blueprint $table) {
            $table->id();
            $table->integer('warehouse_entries_id');
            $table->integer('inventory_id');
            $table->string('numInv', 35);
            $table->float('catidad');
            $table->integer('measurementunits_id');
            $table->string('descripcion', 150);
            $table->float('pUnit', 26, 6);
            $table->float('total', 26, 6);
            $table->string('ordenCompra', 15);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_products');
    }
};
