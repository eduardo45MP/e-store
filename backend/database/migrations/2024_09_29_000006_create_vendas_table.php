<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id(); // PK
            $table->foreignId('usuario_id')->constrained('users'); // Referenciando a tabela correta
            $table->dateTime('data_venda');
            $table->decimal('total', 10, 2);
            $table->timestamps(); // data_criacao e data_atualizacao
        });
    }

    public function down()
    {
        Schema::dropIfExists('vendas');
    }
}
