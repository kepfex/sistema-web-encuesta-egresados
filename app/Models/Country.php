<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'pais';
    protected $primaryKey = 'idPais';
    public $timestamps = false;

    public function departamentos()
    {
        return $this->hasMany(Department::class, 'idPais', 'idPais');
    }
}
