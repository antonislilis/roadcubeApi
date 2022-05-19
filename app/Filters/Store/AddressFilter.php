<?php

namespace App\Filters\Store;

use App\Filters\FilterInterface;

class AddressFilter implements FilterInterface
{
    public function filter($builder, $value, $request)
    {
        return $builder->where('address', 'like', "%{$value}%");
    }
}
