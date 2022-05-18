<?php

namespace App\Filters\Store;

class CoordinatesFilter
{
    public function filter($builder, $value, $request)
    {
        $requestHasAllParameters = $request->exists('lat')
            && $request->exists('lon')
            && $request->exists('radius');

        if ($value && $requestHasAllParameters) {
            return $builder->whereRaw("earth_box(ll_to_earth(:lat,:lon), :radius) @> ll_to_earth(lat, lon)",
                [
                    'lat' => $request->get('lat'),
                    'lon' => $request->get('lon'),
                    'radius' => $request->get('radius') * 1000
                ]
            );
        }
    }
}
