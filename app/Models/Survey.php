<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Survey extends Model
{
    /** @use HasFactory<\Database\Factories\SurveysFactory> */
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'graduate_id',

        // Paso 3: Datos personales
        'edad',
        'sexo',
        'fecha_nacimiento',
        'nacimiento_distrito_id',

        // Paso 4: Actividad Laboral
        'desempeno_post_egreso',
        'desempeno_post_titulacion',
        'tiempo_sin_trabajar_egreso',
        'tiempo_sin_trabajar_titulacion',
        'desempeno_en_su_area',
        'condicion_laboral',
        'remuneracion_mensual',
        'motivo_no_ejerce_carrera',

        'es_independiente',
        'es_dependiente',
        'no_aplica_empleo',

        'independiente_descripcion',

        'dependiente_empresa_nombre',
        'dependiente_empresa_direccion',
        'dependiente_empresa_departamento_id',
        'dependiente_empresa_provincia_id',
        'dependiente_empresa_distrito_id',
        'dependiente_empresa_tipo',
        'dependiente_empresa_ruc',
        'dependiente_empresa_rubro',
        'dependiente_empresa_jefe',
        'dependiente_cargo',
        'dependiente_fecha_ingreso',
        'dependiente_condicion_cargo',
        'condicion_formalidad',

        // Paso 5: Evaluación formación
        'calificacion_formacion',
        'utilidad_contenido',
        'satisfaccion_formacion',

        // Paso 6: Medios de contacto
        'medio_contacto_preferido',
        'disponibilidad_dias',
        'disponibilidad_horarios',

        // Paso 7: Otras actividades
        'otra_actividad_descripcion',
        'sin_otra_actividad',
        'estudia_otra_carrera',
        'otra_carrera_nombre',
        'otra_carrera_institucion',
        'otra_carrera_tipo_institucion',

        // Paso 8: Sugerencias
        'sugerencias',

        'fecha_completado',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'desempeno_post_egreso' => 'boolean',
        'desempeno_post_titulacion' => 'boolean',
        'desempeno_en_su_area' => 'boolean',

        'es_independiente' => 'boolean',
        'es_dependiente' => 'boolean',
        'no_aplica_empleo' => 'boolean',

        'sin_otra_actividad' => 'boolean',
        'estudia_otra_carrera' => 'boolean',

        'fecha_nacimiento' => 'date',
        'dependiente_fecha_ingreso' => 'date',
        'fecha_completado' => 'datetime',

        'disponibilidad_horarios' => 'array',
    ];

    /**
     * Get the graduate that owns the survey.
     */
    public function graduate(): BelongsTo
    {
        return $this->belongsTo(Graduate::class);
    }

    public function dependienteEmpresaDistrito()
    {
        return $this->belongsTo(District::class, 'dependiente_empresa_distrito_id', 'idDistrito');
    }
    public function distritoNacimiento()
    {
        return $this->belongsTo(District::class, 'nacimiento_distrito_id', 'idDistrito');
    }

    /**
     * Genera el código de la encuesta dinámicamente.
     */
    protected function codigoEncuesta(): Attribute
    {
        return Attribute::make(
            get: fn () => 'EE-' 
                . str_pad($this->id, 4, '0', STR_PAD_LEFT) 
                . '-' . $this->fecha_completado->year,
        );
    }
}
