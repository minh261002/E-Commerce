<?php

namespace App\Repositories\Interfaces;


interface BaseRepositoryInterface
{
    public function all();

    public function findById(int $id);
    public function create(array $payload = []);
    public function update(int $id, array $payload = []);
    public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload = []);
    public function delete(int $id);
    public function forceDelete(int $id = 0);
    public function pagination(
        array $column = ['*'],
        array $condition = [],
        array $join = [],
        array $extend = [],
        int $perpage = 10,
    );

}