<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'produtos';
    protected $fillable = [
        'nome',
        'descricao',
        'codigo_interno',
        'codigo_externo',
        'marca',
        'grupo',
        'sub_grupo',
        'visivel',
        'image_url',
        'marca_do_produto',
        'codigo_de_pesquisa_1',
        'codigo_de_pesquisa_2',
        'codigo_de_pesquisa_3',
        'codigo_de_pesquisa_4',
        'codigo_de_pesquisa_5',
        'codigo_de_pesquisa_6',
    ];
}
