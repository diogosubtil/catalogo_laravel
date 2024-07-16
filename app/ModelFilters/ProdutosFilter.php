<?php

namespace App\ModelFilters;

use Illuminate\Database\Eloquent\Builder;

trait ProdutosFilter
{

    public function nome(Builder $builder, $value)
    {
        return $builder->where('nome', 'like', '%'.$value.'%');
    }

}
