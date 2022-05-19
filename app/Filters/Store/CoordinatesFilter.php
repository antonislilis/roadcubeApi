<?php

namespace App\Filters\Store;

use App\Filters\FilterInterface;

class CoordinatesFilter implements FilterInterface
{
    public function filter($builder, $value, $request)
    {
        $requestHasAllParameters = $request->exists('lat')
            && $request->exists('lon')
            && $request->exists('radius');

        if ($value && $requestHasAllParameters) {
            return $builder->whereRaw("earth_box(ll_to_earth(?,?), ?) @> ll_to_earth(lat, lon)",
                [ $request->get('lat'), $request->get('lon'), $request->get('radius') * 1000 ]
            );
        }
    }
}
