<?php

namespace App\Filters;

use App\Filters\Store\AddressFilter;
use App\Filters\Store\AppNameFilter;
use App\Filters\Store\CoordinatesFilter;
use App\Filters\Store\NameFilter;

class StoreFilter extends AbstractFilter
{
    protected $filters = [
        'name' => NameFilter::class,
        'app_name' => AppNameFilter::class,
        'address' => AddressFilter::class,
        'lat' => CoordinatesFilter::class,
    ];
}
