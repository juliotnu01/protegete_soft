<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function hasRequisitos()
    {
        return $this->hasMany(Requisito::class, 'cantidato_id');
    }
}
