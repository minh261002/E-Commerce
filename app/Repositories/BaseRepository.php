<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;

use App\Models\Base;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(
        Model $model
    ) {
        $this->model = $model;
    }

    public function pagination(
        array $column = ['*'],
        array $condition = [],
        array $join = [],
        array $extend = [],
        int $perpage = 10
    ) {
        $query = $this->model
            ->select($column)
            ->where(function ($queryWhere) use ($condition) {
                if (isset($condition['keyword']) && !empty($condition['keyword'])) {
                    $queryWhere->where('name', 'like', '%' . $condition['keyword'] . '%');
                }
            });
        if (isset($join) && !empty($join)) {
            $query->join(...$join);
        }

        return $query->paginate($perpage)->withQueryString()->withPath(env("APP_URL") . $extend['path']);
    }

    public function create(array $payload = [])
    {
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    public function update(int $id, array $payload = [])
    {
        $model = $this->findById($id);
        return $model->update($payload);
    }

    public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload = [])
    {
        return $this->model->whereIn($whereInField, $whereIn)->update($payload);
    }

    public function delete(int $id)
    {
        $model = $this->findById($id);
        return $model->delete();
    }

    public function forceDelete(int $id = 0)
    {
        $model = $this->findById($id);
        return $model->forceDelete();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function findById(
        int $modelId,
        array $columns = ['*'],
        array $relations = []
    ) {
        return $this->model->select($columns)->with($relations)->findOrFail($modelId);
    }
}