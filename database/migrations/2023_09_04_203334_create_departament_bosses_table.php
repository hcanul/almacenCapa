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
        Schema::create('departament_bosses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->integer('job_id');
            $table->integer('workarea_id');
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
        Schema::dropIfExists('departament_bosses');
    }
};
