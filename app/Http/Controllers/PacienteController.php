<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Display the specified resource ===> Adaptado para juntar as funcoes.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        return  $id ? Paciente::find($id) : Paciente::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'nome' => 'required',
            'dataNascimento' => 'required',
            'email' => 'required',
            'contacto' => 'required',
            'residencia' => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else {
            $Paciente = new Paciente;
            $Paciente->nome = $request->nome;
            $Paciente->dataNascimento = $request->dataNascimento;
            $Paciente->email = $request->email;
            $Paciente->contacto = $request->contacto;
            $Paciente->residencia = $request->residencia;

            $Paciente->created_at = date('Y-m-d H:i:s');
            $save =   $Paciente->save();
            return $save  ? ["Resultado" => "Dados guardados com sucesso"]
                :  ["Resultado" => "Falha ao guardar dados"];
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'dataNascimento' => 'required',
            'email' => 'required',
            'contacto' => 'required',
            'residencia' => 'required',
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else {
            $Paciente = Paciente::find($request->id);

            $Paciente->nome = $request->nome;
            $Paciente->dataNascimento = $request->dataNascimento;
            $Paciente->email = $request->email;
            $Paciente->contacto = $request->contacto;
            $Paciente->residencia = $request->residencia;



            $Paciente->updated_at = date('Y-m-d H:i:s');
            $update =  $Paciente->save();

            return $update ? ["Resultado" => "Dados actualizados com sucesso"]
                : ["Resultado" => "Falha ao actualizar dados "];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Paciente = Paciente::find($id);
        $delete = $Paciente->delete();

        return $delete ? ["Resultado" => "Dados apagados com sucesso"]
            : ["Resultado" => "Falha ao apagar dados "];
    }


    function getConsultas($Paciente_id)
    {
        $Paciente = Paciente::find($Paciente_id);
        if ($Paciente == null)
            return null;
        else {
            if ($Paciente->getConsultas()->get() == null)
                return null;
            else
                return $Paciente->getConsultas()->get();
        }
    }
}
