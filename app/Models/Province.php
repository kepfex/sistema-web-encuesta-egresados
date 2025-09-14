<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $primaryKey = 'idProvincia';
    public $timestamps = false;

    public function departamento()
    {
        return $this->belongsTo(Department::class, 'idDepartamento', 'idDepartamento');
    }

    public function distritos()
    {
        return $this->hasMany(District::class, 'idProvincia', 'idProvincia');
    }
}
