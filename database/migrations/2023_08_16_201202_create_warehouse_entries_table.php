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
        Schema::create('warehouse_entries', function (Blueprint $table) {
            $table->id();
            $table->string('proveedor');
            $table->string('nomComer');
            $table->date('fecha');
            $table->string('fol_entrada', 30);
            $table->enum('factura',['Factura', 'Nota', 'Sal. Almacen Gral.']);
            $table->string('nFactura', 15);
            $table->string('ordenCompra', 15);
            $table->string('workarea_id', 150);
            $table->string('nReq', 15);
            $table->string('oSolicitante', 100);
            $table->enum('tCompraContrato', ["Solicitud", "Asignacion", "SalidaAlmacen", "Compra"]);
            $table->float('total', 20,2);
            $table->text('observaciones');
            $table->string('nombrerecibe', 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_entries');
    }
};
