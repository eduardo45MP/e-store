<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use App\Models\ItemVenda;

class Venda extends Model
{
    use HasFactory;

    protected $table = 'vendas';

    protected $fillable = [
        'usuario_id',
        'data_venda',
        'total',
    ];

    // Relações
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function itens()
    {
        return $this->hasMany(ItemVenda::class);
    }
}