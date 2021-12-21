<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;
    public $table = "consultas";

    function getPaciente()
    {
        return $this->belongsTo(Paciente::class,  'pacienteId');
    }
    function getMedico()
    {
        return $this->belongsTo(Medico::class,  'medeicoId');
    }
    function getServico()
    {
        return $this->belongsTo(Servico::class,  'servicoId');
    }
}
