<?php
// app/Models/Estoque.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    // Definindo explicitamente a tabela associada ao modelo
    protected $table = 'estoque';

    // Definindo os campos que podem ser preenchidos em massa (mass assignment)
    protected $fillable = [
        'produto_id',           // Chave estrangeira referenciando o produto
        'quantidade',           // Quantidade movimentada (entrada/saída)
        'tipo_movimentacao',    // Tipo de movimentação (exemplo: 'entrada' ou 'saída')
        'data_movimentacao',    // Data da movimentação no estoque
    ];

    // Definindo o relacionamento entre o modelo Estoque e Produto
    public function produto()
    {
        // Um registro de estoque pertence a um único produto
        return $this->belongsTo(Produto::class);
    }
}
