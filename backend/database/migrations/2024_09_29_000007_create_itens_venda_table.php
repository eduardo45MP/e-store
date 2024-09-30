<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItensVendaTable extends Migration
{
    public function up()
    {
        Schema::create('itens_venda', function (Blueprint $table) {
            $table->id(); // PK
            $table->foreignId('venda_id')->constrained('vendas')->onDelete('cascade'); // Chave estrangeira para vendas
            $table->foreignId('produto_id')->constrained('produtos')->onDelete('cascade'); // Chave estrangeira para produtos
            $table->integer('quantidade');
            $table->decimal('preco_unitario', 10, 2);
        });
    }

    public function down()
    {
        Schema::dropIfExists('itens_venda');
    }
}
