<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Consulta;

class Servico extends Model
{
    use HasFactory;
    public $table = "servicos";

    function getConsultas()
    {
        return $this->hasMany(Consulta::class,  'pacienteId');
    }
}
