<?php
//app/Models/Produto.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    // Inclui todos os campos que podem ser atribuídos em massa
    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'quantidade', // Aqui, eu troquei de 'estoque' para 'quantidade'
    ];

    // Relações
    public function itensVenda()
    {
        return $this->hasMany(ItemVenda::class);
    }

    public function estoqueMovimentacoes()
    {
        return $this->hasMany(Estoque::class);
    }
}
