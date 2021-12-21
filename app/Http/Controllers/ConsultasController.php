<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;

class ConsultasController extends Controller
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
        return  $id ? Consulta::find($id) : Consulta::all();
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


            'tipo' => 'required',
            'data' => 'required',
            'Hora' => 'required',
            'status' => 'required',
            'medicoId' => 'required',
            'pacienteId' => 'required',
            'servicoId' => 'required',


        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else {
            $Consulta = new Consulta;
            $Consulta->tipo = $request->tipo;
            $Consulta->data = $request->data;
            $Consulta->Hora = $request->Hora;
            $Consulta->status = $request->status;
            $Consulta->medicoId = $request->medicoId;
            $Consulta->pacienteId = $request->pacienteId;
            $Consulta->servicoId = $request->servicoId;


            $Consulta->created_at = date('Y-m-d H:i:s');
            $save =   $Consulta->save();
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
            'tipo' => 'required',
            'data' => 'required',
            'Hora' => 'required',
            'status' => 'required',
            'medicoId' => 'required',
            'pacienteId' => 'required',
            'servicoId' => 'required',
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else {
            $Consulta = Consulta::find($request->id);

            $Consulta->tipo = $request->tipo;
            $Consulta->data = $request->data;
            $Consulta->Hora = $request->Hora;
            $Consulta->status = $request->status;
            $Consulta->medicoId = $request->medicoId;
            $Consulta->pacienteId = $request->pacienteId;
            $Consulta->servicoId = $request->servicoId;


            $Consulta->updated_at = date('Y-m-d H:i:s');
            $update =  $Consulta->save();

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
        $Consulta = Consulta::find($id);
        $delete = $Consulta->delete();

        return $delete ? ["Resultado" => "Dados apagados com sucesso"]
            : ["Resultado" => "Falha ao apagar dados "];
    }


    function getPaciente($Consulta_id)
    {
        $Consulta = Consulta::find($Consulta_id);
        if ($Consulta == null)
            return null;
        else {
            if ($Consulta->getPaciente() == null)
                return null;
            else
                return $Consulta->getPaciente();
        }
    }

    function getMedico($Consulta_id)
    {
        $Consulta = Consulta::find($Consulta_id);
        if ($Consulta == null)
            return null;
        else {
            if ($Consulta->getMedico() == null)
                return null;
            else
                return $Consulta->getMedico();
        }
    }

    function getServico($Consulta_id)
    {
        $Consulta = Consulta::find($Consulta_id);
        if ($Consulta == null)
            return null;
        else {
            if ($Consulta->getServico() == null)
                return null;
            else
                return $Consulta->getServico();
        }
    }
}
