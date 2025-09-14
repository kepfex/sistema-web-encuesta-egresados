<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryLink extends Model
{
    /** @use HasFactory<\Database\Factories\TemporaryLinkFactory> */
    use HasFactory;

    /**
     * The table associated with the model.
     * Laravel asume 'temporary_links', pero es bueno ser explícito.
     */
    protected $table = 'temporary_links';

    /**
     * The attributes that are mass assignable.
     * Usamos los nombres exactos de tu nueva migración.
     */
    protected $fillable = [
        'token',
        'nombre_campania',
        'fecha_expiracion',
        'maximo_usos',
        'usos_actuales',
        'esta_activo',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'fecha_expiracion' => 'datetime',
        'esta_activo' => 'boolean',
    ];
}
