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

    public function pagination($column = ['*'], $condition = [], $join = [], $perpage = 10)
    {
        $query = $this->model
                ->select($column)
                ->where($condition);
        if(isset($join) && !empty($join)) {
            $query->join(...$join);
        }

        return $query->paginate($perpage);
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