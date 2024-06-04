<?php

namespace App\Repositories\Interfaces;


interface BaseRepositoryInterface
{
    public function all();

    public function findById(int $id);
    public function create(array $payload = []);
    public function update(int $id, array $payload = []);
    public function delete(int $id);
    public function forceDelete(int $id = 0);
    public function pagination($column = ['*'], $condition = [], $join = [], $perpage = 10);
}