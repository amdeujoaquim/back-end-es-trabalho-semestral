<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;
use Validator;

class MedicoController extends Controller
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
        return  $id ? Medico::find($id) : Medico::all();
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
            'Especialidade' => 'required',
            'email' => 'required',
            'contacto' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else {
            $Medico = new Medico;
            $Medico->nome = $request->nome;
            $Medico->Especialidade = $request->Especialidade;
            $Medico->email = $request->email;
            $Medico->contacto = $request->contacto;

            $Medico->created_at = date('Y-m-d H:i:s');
            $save =   $Medico->save();
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
            'Especialidade' => 'required',
            'email' => 'required',
            'contacto' => 'required',
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else {
            $Medico = Medico::find($request->id);

            $Medico->nome = $request->nome;
            $Medico->Especialidade = $request->Especialidade;
            $Medico->email = $request->email;
            $Medico->contacto = $request->contacto;

            $Medico->updated_at = date('Y-m-d H:i:s');
            $update =  $Medico->save();

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
        $Medico = Medico::find($id);
        $delete = $Medico->delete();

        return $delete ? ["Resultado" => "Dados apagados com sucesso"]
            : ["Resultado" => "Falha ao apagar dados "];
    }


    function getConsultas($medico_id)
    {
        $medico = Medico::find($medico_id);
        if ($medico == null)
            return null;
        else {
            if ($medico->getConsultas()->get() == null)
                return null;
            else
                return $medico->getConsultas()->get();
        }
    }
}
