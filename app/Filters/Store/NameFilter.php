<?php

namespace App\Filters\Store;

use App\Filters\FilterInterface;

class NameFilter implements FilterInterface
{
    public function filter($builder, $value, $request)
    {
        return $builder->where('name', 'like', "%{$value}%");
    }
}
