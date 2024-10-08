<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produtos', function (Blueprint $table) {
            // Alterar o nome do campo estoque para quantidade, se for o caso
            if (Schema::hasColumn('produtos', 'estoque')) {
                $table->renameColumn('estoque', 'quantidade');
            }

            // Adicionar a coluna descricao se ela não existir
            if (!Schema::hasColumn('produtos', 'descricao')) {
                $table->text('descricao')->nullable()->after('nome'); // Adiciona o campo após o nome
            }
            
            // Alterar o tamanho ou outras propriedades de um campo, se necessário
            $table->decimal('preco', 10, 2)->change(); // Modifica a coluna de preço para decimal(10, 2)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            // Reverter o nome do campo quantidade para estoque, se necessário
            if (Schema::hasColumn('produtos', 'quantidade')) {
                $table->renameColumn('quantidade', 'estoque');
            }

            // Remover a coluna descricao, se necessário
            if (Schema::hasColumn('produtos', 'descricao')) {
                $table->dropColumn('descricao');
            }
            
            // Reverter as alterações no campo preço
            $table->decimal('preco', 8, 2)->change(); // Retorna ao formato original se necessário
        });
    }
}
