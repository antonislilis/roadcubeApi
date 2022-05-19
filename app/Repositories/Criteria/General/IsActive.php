<?php

namespace App\Repositories\Criteria\General;

use App\Repositories\Criteria\Criteria;
use App\Repositories\RepositoryInterface;

class IsActive extends Criteria
{

    public function apply($model, RepositoryInterface $repository, $data = null)
    {
        $query = $model->where('is_active', true);
        return $query;
    }
}
