<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;
use Validator;


class ServicoController extends Controller
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
        return  $id ? Servico::find($id) : Servico::all();
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

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else {
            $Servico = new Servico;
            $Servico->nome = $request->nome;


            $Servico->created_at = date('Y-m-d H:i:s');
            $save =   $Servico->save();
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

            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else {
            $Servico = Servico::find($request->id);

            $Servico->nome = $request->nome;


            $Servico->updated_at = date('Y-m-d H:i:s');
            $update =  $Servico->save();

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
        $Servico = Servico::find($id);
        $delete = $Servico->delete();

        return $delete ? ["Resultado" => "Dados apagados com sucesso"]
            : ["Resultado" => "Falha ao apagar dados "];
    }


    function getConsultas($Servico_id)
    {
        $Servico = Servico::find($Servico_id);
        if ($Servico == null)
            return null;
        else {
            if ($Servico->getConsultas()->get() == null)
                return null;
            else
                return $Servico->getConsultas()->get();
        }
    }
}
