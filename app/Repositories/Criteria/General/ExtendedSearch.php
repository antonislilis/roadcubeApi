<?php

namespace App\Repositories\Criteria\General;

use App\Repositories\Criteria\Criteria;
use App\Repositories\RepositoryInterface as Repository;

class ExtendedSearch extends Criteria
{
    private $fields;
    private $id;
    private $relation;
    private $whereKey;
    private $assigned;

    function __construct($fields, $id = 0, $relation, $whereKey, $assigned)
    {
        $this->fields = $fields;
        $this->id = $id;
        $this->relation = $relation;
        $this->whereKey = $whereKey;
        $this->assigned = $assigned;
    }

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $objectId = $this->id;

        // Separate create from edit functionality
        if($objectId != 0){
            if($this->assigned){
                $query = $model::with($this->relation)->whereHas($this->relation, function($query) use ($objectId) {
                    $query->where($this->whereKey, $objectId);
                });
            } else {
                $query = $model::with($this->relation)->whereDoesntHave($this->relation, function($query) use ($objectId) {
                    $query->where($this->whereKey, $objectId);
                });
            }
        } else {
            $query = $model;
        }

        foreach ($this->fields as $key => $field){
            if (!is_null($field)) {
                $query = $query->where($key, 'like', '%'.$field.'%');
            }
        }

        return $query;
    }
}