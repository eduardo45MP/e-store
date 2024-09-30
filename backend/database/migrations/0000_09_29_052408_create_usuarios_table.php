<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // PK
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('senha');
            $table->timestamps(); // data_criacao e data_atualizacao
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
