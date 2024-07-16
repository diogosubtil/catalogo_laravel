<?php

namespace App\ModelFilters;

use Illuminate\Database\Eloquent\Builder;

trait UsersFilter
{
    /**
     * This is a sample custom query
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param                                       $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filterByName(Builder $builder, $value)
    {
        return $builder->where('name', 'like', '%'.$value.'%');
    }
}
