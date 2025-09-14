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
        Schema::create('graduates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('programs');
            $table->integer('residencia_distrito_id')->nullable();
            
            $table->string('nombre_completo');
            $table->string('dni', 8)->unique();
            $table->string('correo_electronico');
            $table->string('numero_celular', 15)->nullable();
            
            $table->year('anio_egreso');
            $table->date('fecha_titulacion')->nullable();
            $table->string('direccion_residencia')->nullable();
            
            $table->timestamps();

            $table->foreign('residencia_distrito_id')->references('idDistrito')->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduates');
    }
};
