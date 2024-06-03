<?php

namespace App\Repositories\Interfaces;


interface BaseRepositoryInterface
{
    public function all();

    public function findById(
        int $id,
        array $columns = ['*'],
        array $relations = []
    );
}