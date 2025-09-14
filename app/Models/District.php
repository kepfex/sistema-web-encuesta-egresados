<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $primaryKey = 'idDistrito';
    public $timestamps = false;

    public function provincia()
    {
        return $this->belongsTo(Province::class, 'idProvincia', 'idProvincia');
    }
}
