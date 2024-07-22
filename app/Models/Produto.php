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
        'marca_do_produto',
        'marca',
        'grupo',
        'sub_grupo',
        'visivel',
        'image_url',
    ];
}
