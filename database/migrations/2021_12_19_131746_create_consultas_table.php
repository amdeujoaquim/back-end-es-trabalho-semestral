<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->date('data');
            $table->string('Hora');

            $table->string('status');

            $table->foreignId('medicoId')
                ->constrained('medico')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('pacienteId')
                ->constrained('paciente')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('servicoId')
                ->constrained('servicos')->onUpdate('cascade')->onDelete('cascade');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultas');
    }
}
