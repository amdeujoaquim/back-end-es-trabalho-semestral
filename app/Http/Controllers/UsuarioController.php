<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
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
        return  $id ? Usuario::find($id) : Usuario::all();
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
            'senha' => 'required',
            'userName' => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else {
            $Usuario = new Usuario;
            $Usuario->nome = $request->nome;
            $Usuario->senha = $request->senha;
            $Usuario->userName = $request->userName;



            $Usuario->created_at = date('Y-m-d H:i:s');
            $save =   $Usuario->save();
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
            'senha' => 'required',
            'userName' => 'required',
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else {
            $Usuario = Usuario::find($request->id);
            $Usuario->nome = $request->nome;
            $Usuario->senha = $request->senha;
            $Usuario->userName = $request->userName;


            $Usuario->updated_at = date('Y-m-d H:i:s');
            $update =  $Usuario->save();

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
        $Usuario = Usuario::find($id);
        $delete = $Usuario->delete();

        return $delete ? ["Resultado" => "Dados apagados com sucesso"]
            : ["Resultado" => "Falha ao apagar dados "];
    }
}
