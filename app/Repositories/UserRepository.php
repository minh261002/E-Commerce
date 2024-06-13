<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function pagination(
        array $column = ['*'],
        array $condition = [],
        array $join = [],
        array $extend = [],
        int $perpage = 10,
        array $relations = []
    ) {
        $query = $this->model
            ->select($column)
            ->where(function ($queryWhere) use ($condition) {
                if (isset($condition['keyword']) && !empty($condition['keyword'])) {
                    $queryWhere->where('name', 'like', '%' . $condition['keyword'] . '%')
                        ->orWhere('email', 'like', '%' . $condition['keyword'] . '%')
                        ->orWhere('phone', 'like', '%' . $condition['keyword'] . '%')
                        ->orWhere('address', 'like', '%' . $condition['keyword'] . '%');
                }

                if (
                    isset($condition['publish']) && $condition['publish'] != -1
                ) {
                    $queryWhere->where('publish', $condition['publish']);
                }
            });
        if (isset($join) && !empty($join)) {
            $query->join(...$join);
        }

        return $query->paginate($perpage)->withQueryString()->withPath(env("APP_URL") . $extend['path']);
    }

}