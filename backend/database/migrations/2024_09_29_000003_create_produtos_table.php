<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id(); // PK
            $table->string('nome', 100);
            $table->text('descricao');
            $table->decimal('preco', 10, 2);
            $table->integer('estoque');
            $table->timestamps(); // data_criacao e data_atualizacao
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos');
    }
};
