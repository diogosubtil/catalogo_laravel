<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory, SoftDeletes;

    private static array $whiteListFilter = ['*'];
    protected $dates = ['deleted_at'];

    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'descricao',
        'codigo_interno',
        'codigo_externo',
        'marca',
        'veiculo',
        'linha_do_produto',
        'visivel',
        'image_url',
    ];
}
