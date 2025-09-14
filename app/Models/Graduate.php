<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Graduate extends Model
{
    /** @use HasFactory<\Database\Factories\GraduateFactory> */
    use HasFactory;

    /**
     * Los atributos que se pueden asignar de forma masiva.
     */
    protected $fillable = [
        'program_id',
        'residencia_distrito_id',
        'nombre_completo',
        'dni',
        'correo_electronico',
        'numero_celular',
        'anio_egreso',
        'fecha_titulacion',
        'direccion_residencia',
    ];

    protected $casts = [
        'anio_egreso' => 'integer',
        'residencia_distrito_id' => 'integer',
        'fecha_titulacion' => 'date',
    ];

    /**
     * Un egresado pertenece a un programa.
     */
    public function programa()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    /**
     * Relación con el distrito de residencia.
     */
    public function distritoResidencia()
    {
        return $this->belongsTo(District::class, 'residencia_distrito_id', 'idDistrito');
    }

    /**
     * Un egresado puede tener solo una encuesta.
     */
    public function survey(): HasOne
    {
        return $this->hasOne(Survey::class);
    }
}
