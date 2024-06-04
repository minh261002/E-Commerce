<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    public function __construct(
        protected UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function paginate()
    {
        return $this->userRepository->pagination(['*']);
    }

    public function create($request)
    {
        DB::beginTransaction();

        try {
            $payload = $request->except(['_token', 'password_confirmation']);
            $payload['birthday'] = $this->convertBirthdayDate($payload['birthday']);
            $payload['password'] = Hash::make(($payload['password']));

            $user = $this->userRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    public function update($id, $request)
    {
        DB::beginTransaction();

        try {
            $payload = $request->except(['_token']);
            $payload['birthday'] = $this->convertBirthdayDate($payload['birthday']);
            $user = $this->userRepository->update($id, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $user = $this->userRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    private function convertBirthdayDate($birthday = '')
    {
        $carbonDate = Carbon::createFromFormat('Y-m-d', $birthday);
        $birthday = $carbonDate->format('Y-m-d H:i:s');

        return $birthday;
    }
}