<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use App\Models\Venda;

class Usuario extends Venda
{
    use HasFactory;

    protected $table = 'usuarios'; // nome da tabela

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'tipo',
    ];

    protected $hidden = [
        'senha', // oculta a senha nas respostas
    ];

    // Relações
    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }
}