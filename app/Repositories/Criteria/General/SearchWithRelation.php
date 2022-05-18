<?php

namespace App\Repositories\Criteria\General;

use App\Repositories\Criteria\Criteria;
use App\Repositories\RepositoryInterface as Repository;

class SearchWithRelation extends Criteria
{
    private $fields;
    private $id;
    private $relation;
    private $whereKey;

    function __construct($fields, $id = 0, $relation, $whereKey)
    {
        $this->fields = $fields;
        $this->id = $id;
        $this->relation = $relation;
        $this->whereKey = $whereKey;
    }

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $objectId = $this->id;

        if($objectId != 0){
            //$query = $model->();
        } else {
            $query = $model::with($this->relation);
        }

        foreach ($this->fields as $key => $field){
            if (!is_null($field)) {
                $query = $query->where($key, 'like', $field.'%');
            }
        }

        return $query;
    }
}