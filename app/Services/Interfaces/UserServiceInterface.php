<?php

namespace App\Services\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface UserServiceInterface
{
    public function paginate($request);

    public function create($request);

    public function update($request, $id);

    public function updateStatus($request);

    public function delete($id);
}