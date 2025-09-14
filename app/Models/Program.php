<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    /** @use HasFactory<\Database\Factories\ProgramFactory> */
    use HasFactory;

    /**
     * Los atributos que se pueden asignar de forma masiva.
     */
    protected $fillable = [
        'nombre',
    ];

    /**
     * Un programa tiene muchos egresados.
     */
    public function egresados()
    {
        return $this->hasMany(Graduate::class);
    }
}
