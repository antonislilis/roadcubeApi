<?php

namespace App\Repositories;

interface RepositoryInterface
{

    public function all();

    public function paginate($perPage = 15);

    public function create(array $data);

    public function update(array $data, $value);

    public function delete($id);

    public function find($id);

    public function findFirstBy($attribute, $value);

    public function where($attribute, $operator = '=', $value);

    public function attach($relation, $source, $target);

    public function sync($relation, $source, $target);

    public function with($relation);

    public function whereNotHave($relation, $id, $whereKey);

    public function query();

    public function truncate();

}
