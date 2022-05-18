<?php

namespace App\Filters\Store;

class AddressFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('address', 'like', "%{$value}%");
    }
}
