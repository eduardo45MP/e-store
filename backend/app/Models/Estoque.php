<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $table = 'estoque';

    protected $fillable = [
        'produto_id',
        'quantidade',
        'tipo_movimentacao',
        'data_movimentacao',
    ];

    // Relações
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}