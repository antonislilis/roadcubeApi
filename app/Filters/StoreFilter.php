<?php

// ProductFilter.php

namespace App\Filters;

use App\Filters\AbstractFilter;
use App\Filters\Store\AddressFilter;
use App\Filters\Store\AppNameFilter;
use App\Filters\Store\CoordinatesFilter;
use App\Filters\Store\NameFilter;
use Illuminate\Database\Eloquent\Builder;

class StoreFilter extends AbstractFilter
{
    protected $filters = [
        'name' => NameFilter::class,
        'app_name' => AppNameFilter::class,
        'address' => AddressFilter::class,
        'coordinates' => CoordinatesFilter::class,
    ];
}
