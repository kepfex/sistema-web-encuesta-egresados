<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $primaryKey = 'idDepartamento';
    public $timestamps = false;

    public function pais()
    {
        // Un departamento pertenece a un País.
        return $this->belongsTo(Country::class, 'idPais', 'idPais');
    }

    public function provincias()
    {
        // Un departamento tiene muchas Provincias.
        return $this->hasMany(Province::class, 'idDepartamento', 'idDepartamento');
    }
}
