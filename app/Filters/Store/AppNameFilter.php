<?php

namespace App\Filters\Store;

use App\Filters\FilterInterface;

class AppNameFilter implements FilterInterface
{
    public function filter($builder, $value, $request)
    {
        return $builder->where('app_name', 'like', "%{$value}%");
    }
}
