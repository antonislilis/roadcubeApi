<?php

namespace App\Filters\Store;

class NameFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('name', 'like', "%{$value}%");
    }
}
