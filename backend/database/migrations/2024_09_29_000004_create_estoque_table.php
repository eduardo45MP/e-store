<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstoqueTable extends Migration
{
        // In CreateEstoqueTable
        public function up()
        {
            Schema::create('estoque', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('produto_id');
                $table->integer('quantidade');
                $table->enum('tipo_movimentacao', ['entrada', 'saida']);
                $table->timestamp('data_movimentacao');
                $table->timestamps();
            });
        }


    public function down()
    {
        // Drop foreign key and then drop the 'estoque' table
        Schema::table('estoque', function (Blueprint $table) {
            $table->dropForeign(['produto_id']); // Drop the foreign key constraint
        });

        Schema::dropIfExists('estoque'); // Drop the 'estoque' table
    }
};
