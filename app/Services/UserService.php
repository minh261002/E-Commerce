<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    public function __construct(
        protected UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function paginate()
    {
        return $this->userRepository->getAllPaginate();
    }
}