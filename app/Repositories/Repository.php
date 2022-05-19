<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use App\Repositories\Criteria\Criteria;
use App\Repositories\Criteria\CriteriaInterface;

abstract class Repository implements RepositoryInterface, CriteriaInterface
{
    /**
     * @var App
     */
    private $app;

    /**
     * @var
     */
    protected $model;

    /**
     * @var Collection
     */
    protected $criteria;

    /**
     * @var bool
     */
    protected $skipCriteria = false;


    /**
     * @param App $app
     * @param Collection $collection
     * @throws \Exception
     */
    public function __construct(App $app, Collection $collection)
    {
        $this->app = $app;
        $this->criteria = $collection;
        $this->resetScope();
        $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    abstract function model();

    /**
     * @return Model
     * @throws \Exception
     */
    public function makeModel()
    {

        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        $this->applyCriteria();
        return $this->model->get();
    }


    /**
     * @param $field
     * @param $values
     * @return mixed
     */
    public function whereIn($field, $values)
    {
        $this->applyCriteria();
        return $this->model->whereIn($field, $values);
    }

    /**
     * @param $field
     * @param $values
     * @return mixed
     */
    public function without($field, $values)
    {
        $this->applyCriteria();
        return $this->model->whereNotIn($field, $values);
    }

    /**
     * @param int $perPage
     * @return mixed
     */
    public function paginate($perPage = 15)
    {
        return $this->model->paginate($perPage);
    }

    /**
     * @param $name
     * @param $value
     * @return mixed
     */
    public function orderBy($name, $value)
    {
        return $this->model->orderBy($name, $value);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function groupBy($name)
    {
        return $this->model->groupBy($name);
    }

    /**
     * @param array $model
     * @return mixed
     */
    public function save($model)
    {
        return $model->save();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param $value
     * @param string $attribute
     * @return mixed
     * @internal param $id
     */
    public function update(array $data, $value, $attribute = "id")
    {
        return $this->model->where($attribute, '=', $value)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function findFirstBy($attribute, $value)
    {
        $this->applyCriteria();
        return $this->model->where($attribute, '=', $value)->first();
    }

    /**
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function findFirstByOrFail($attribute, $value)
    {
        $this->applyCriteria();
        return $this->model->where($attribute, '=', $value)->firstOrFail();
    }

    /**
     * @param $relation
     * @param $source
     * @param $target
     */
    public function attach($relation, $source, $target)
    {
        $source->$relation()->attach($target);
    }

    /**
     * @param $relation
     * @param $source
     * @param $target
     */
    public function detach($relation, $source, $target)
    {
        $source->$relation()->detach($target);
    }

    /**
     * @param $relation
     * @param $source
     * @param $target
     */
    public function sync($relation, $source, $target)
    {
        $source->$relation()->sync($target);
    }

    /**
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function where($attribute, $operator = '-', $value)
    {
        $this->applyCriteria();
        return $this->model->where($attribute, $operator, $value)->get();
    }

    /**
     * @param $relation
     * @return mixed
     */
    public function with($relation)
    {
        $this->applyCriteria();
        return $this->model->with($relation);
    }


    /**
     * @param $relation
     * @param $id
     * @param $whereKey
     * @return mixed
     */
    public function whereNotHave($relation, $id, $whereKey)
    {
        $this->applyCriteria();
        return $this->model->with($relation)->whereDoesntHave($relation, function ($query) use ($id, $whereKey) {
            $query->where($whereKey, $id);
        });
    }

    /**
     * @return mixed
     */
    public function query()
    {
        return $this->model->query();
    }

    /**
     * @return mixed
     */
    public function truncate()
    {
        return $this->model->truncate();
    }



    /**
     * CRITERIA FUNCTIONS
     */

    /**
     * @return $this
     */
    public function resetScope()
    {
        $this->skipCriteria(false);
        return $this;
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function skipCriteria($status = true)
    {
        $this->skipCriteria = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCriteria()
    {
        return $this->criteria;
    }

    /**
     * @param Criteria $criteria
     * @param $data
     * @param null $notIn
     * @param $query
     * @return $this
     */
    public function getByCriteria(Criteria $criteria, $data = null, $notIn = null, $query = null)
    {

        return $criteria->apply($this->model, $this, $data, $notIn, $query);
    }

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function pushCriteria(Criteria $criteria)
    {
        $this->criteria->push($criteria);
        return $this;
    }

    /**
     * @return $this
     */
    public function applyCriteria()
    {
        if ($this->skipCriteria === true)
            return $this;

        foreach ($this->getCriteria() as $criteria) {
            if ($criteria instanceof Criteria)
                $this->model = $criteria->apply($this->model, $this);
        }

        return $this;
    }
}
