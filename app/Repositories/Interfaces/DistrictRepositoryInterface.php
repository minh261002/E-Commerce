<?php

namespace App\Repositories\Interfaces;

interface DistrictRepositoryInterface
{
    public function all();

    public function findByProvinceId(int $provinceId);
}
