<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Consulta;
use App\Models\Usuario;

class Medico extends Model
{
    use HasFactory;
    public $table = "medico";

    function getConsultas()
    {
        return $this->hasMany(Consulta::class,  'medicoId');
    }
}
