<?php

use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// rotas para a Medico
Route::get("/getmedico/{id?}", [MedicoController::class, "index"]);
Route::post("/savemedico", [MedicoController::class, "store"]);
Route::delete("/deletemedico/{id}", [MedicoController::class, "destroy"]);
Route::put("/editmedico/{id}", [MedicoController::class, "update"]);
Route::get("/medico/getconsulta/{id}", [MedicoController::class, "getConsultas"]);

// rotas para a paciente
Route::get("/getpaciente/{id?}", [PacienteController::class, "index"]);
Route::post("/savepaciente", [PacienteController::class, "store"]);
Route::delete("/deletepaciente/{id}", [PacienteController::class, "destroy"]);
Route::put("/editpaciente/{id}", [PacienteController::class, "update"]);
Route::get("/paciente/getconsulta/{id}", [PacienteController::class, "getConsultas"]);

// rotas para a usuario
Route::get("/getusuario/{id?}", [UsuarioController::class, "index"]);
Route::post("/saveusuario", [UsuarioController::class, "store"]);
Route::delete("/deleteusuario/{id}", [UsuarioController::class, "destroy"]);
Route::get("/editusuario/{id}", [UsuarioController::class, "update"]);

// rotas para a servico
Route::get("/getservico/{id?}", [ServicoController::class, "index"]);
Route::post("/saveservico", [ServicoController::class, "store"]);
Route::delete("/deleteservico/{id}", [ServicoController::class, "destroy"]);
Route::put("/editservico/{id}", [ServicoController::class, "update"]);
Route::get("/servico/getconsulta/{id}", [ServicoController::class, "getConsultas"]);

// rotas para a consulta
Route::get("/getconsulta/{id?}", [ConsultasController::class, "index"]);
Route::post("/saveconsulta", [ConsultasController::class, "store"]);
Route::delete("/deleteconsulta/{id}", [ConsultasController::class, "destroy"]);
Route::put("/editconsulta/{id}", [ConsultasController::class, "update"]);
Route::put("/consulta/getMedico/{id}", [ConsultasController::class, "getMedico"]);
Route::put("/consulta/getPaciente/{id}", [ConsultasController::class, "getPaciente"]);
Route::put("/consulta/getServico/{id}", [ConsultasController::class, "getServico"]);
