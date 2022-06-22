<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscritos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->string('nome', 30);
            $table->string('cpf',15)->unique();
            $table->string('email')->unique();

            $table->string('estado', 30);
            $table->string('cidade', 25);
            $table->string('bairro', 30);           
            $table->string('logradouro', 30);
            $table->integer('numero');
            $table->string('complemento', 15);
             
            $table->string('cep',10);
            $table->timestamps();
            $table->foreign('usuario_id')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscritos');
    }
}
