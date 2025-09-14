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
        Schema::create('temporary_links', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique();
            $table->string('nombre_campania')->nullable();
            $table->timestamp('fecha_expiracion')->nullable();
            $table->unsignedInteger('maximo_usos')->default(0)->comment('0 para ilimitado');
            $table->unsignedInteger('usos_actuales')->default(0);
            $table->boolean('esta_activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporary_links');
    }
};
