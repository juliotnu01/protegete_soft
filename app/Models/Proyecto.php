<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function hasHistory()
    {
        return $this->hasMany(History::class, 'proyecto_id');
    }
    public function hasSupervisor()
    {
        return $this->hasOne(Candidato::class, 'proyecto_id');
    }
}
