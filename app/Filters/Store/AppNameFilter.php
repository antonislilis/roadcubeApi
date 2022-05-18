<?php

namespace App\Filters\Store;

class AppNameFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('app_name', 'like', "%{$value}%");
    }
}
