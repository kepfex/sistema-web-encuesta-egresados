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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('graduate_id')
                ->constrained('graduates')
                ->onDelete('cascade')
                ->unique();

            // Sección 3: Datos Personales
            $table->integer('edad')->nullable();
            $table->string('sexo', 50)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('nacimiento_distrito_id')->nullable();

            // 🔹 Sección 4: Actividad Laboral
            $table->boolean('desempeno_post_egreso')->nullable();
            $table->boolean('desempeno_post_titulacion')->nullable();
            $table->string('tiempo_sin_trabajar_egreso')->nullable();
            $table->string('tiempo_sin_trabajar_titulacion')->nullable();

            $table->boolean('desempeno_en_su_area')->nullable();
            $table->enum('condicion_laboral', ['laborando', 'no laborando']);
            $table->decimal('remuneracion_mensual', 10, 2)->nullable();
            $table->text('motivo_no_ejerce_carrera')->nullable();

            $table->boolean('es_independiente')->default(false);
            $table->boolean('es_dependiente')->default(false);
            $table->boolean('no_aplica_empleo')->default(false);

            // Independiente
            $table->string('independiente_descripcion')->nullable();

            // Dependiente (incluye ubigeo: departamento, provincia, distrito)
            $table->string('dependiente_empresa_nombre')->nullable();
            $table->string('dependiente_empresa_direccion')->nullable();
            // department = departamento (tu tabla departments usa PK idDepartamento -> increments -> unsigned integer)
            $table->unsignedInteger('dependiente_empresa_departamento_id')->nullable();
            // province = provincia (tu tabla provinces usa PK idProvincia -> increments -> unsigned integer)
            $table->unsignedInteger('dependiente_empresa_provincia_id')->nullable();
            // district = distrito (tu tabla districts usa PK idDistrito -> integer primary)
            $table->integer('dependiente_empresa_distrito_id')->nullable();

            $table->string('dependiente_empresa_tipo')->nullable();
            $table->string('dependiente_empresa_ruc')->nullable();
            $table->string('dependiente_empresa_rubro')->nullable();
            $table->string('dependiente_empresa_jefe')->nullable();
            $table->string('dependiente_cargo')->nullable();
            $table->date('dependiente_fecha_ingreso')->nullable();
            $table->enum('dependiente_condicion_cargo', ['nombrado', 'contratado', 'temporal'])->nullable();
            $table->enum('condicion_formalidad', ['formal', 'informal'])->nullable();
            
            // 🔹 Sección 5: Evaluación de la formación
            $table->enum('calificacion_formacion', ['muy_apropiada', 'apropiada', 'regularmente_apropiada', 'inapropiada']);
            $table->enum('utilidad_contenido', ['si', 'no', 'a medias']);
            $table->tinyInteger('satisfaccion_formacion')->nullable(); // 1 a 5

            // 🔹 Sección 6: Medios de contacto
            $table->enum('medio_contacto_preferido', ['correo', 'whatsapp', 'facebook', 'llamada', 'otro'])->nullable();
            $table->string('disponibilidad_dias')->nullable();
            $table->json('disponibilidad_horarios')->nullable();

            // 🔹 Sección 7: Otras actividades
            $table->text('otra_actividad_descripcion')->nullable();
            $table->boolean('sin_otra_actividad')->default(false);
            $table->boolean('estudia_otra_carrera')->nullable();
            $table->string('otra_carrera_nombre')->nullable();
            $table->string('otra_carrera_institucion')->nullable();
            $table->enum('otra_carrera_tipo_institucion', ['instituto_tecnologico', 'instituto_pedagogico', 'universidad'])->nullable();

            // 🔹 Sección 8: Sugerencias
            $table->text('sugerencias')->nullable();

            $table->timestamp('fecha_completado');

            // --- Llaves foráneas (coinciden con tus migraciones de ubigeo) ---
            $table->foreign('nacimiento_distrito_id')
                  ->references('idDistrito')->on('districts')->onDelete('set null');

            $table->foreign('dependiente_empresa_distrito_id')
                  ->references('idDistrito')->on('districts')->onDelete('set null');

            $table->foreign('dependiente_empresa_provincia_id')
                  ->references('idProvincia')->on('provinces')->onDelete('set null');

            $table->foreign('dependiente_empresa_departamento_id')
                  ->references('idDepartamento')->on('departments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
