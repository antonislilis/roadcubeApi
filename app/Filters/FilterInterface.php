<?php

namespace App\Filters;

interface FilterInterface
{

    public function filter($builder, $value, $request);

}
