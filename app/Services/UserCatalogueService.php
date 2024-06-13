<?php

namespace App\Services;

use App\Services\Interfaces\UserCatalogueServiceInterface;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class UserService
 * @package App\Services
 */
class UserCatalogueService implements UserCatalogueServiceInterface
{
    public function __construct(
        protected UserRepository $userRepository,
        protected UserCatalogueRepository $userCatalogueRepository
    ) {
    }


    public function paginate($request)
    {

        $condition['keyword'] = addslashes($request->get('keyword'));
        $condition['publish'] = $request->get('publish');
        $perPage = $request->integer('perpage');

        $userCatalogues = $this->userCatalogueRepository->pagination(
            $this->paginateSelect(),
            $condition,
            [],
            ['path' => '/user/catalogue/index'],
            $perPage,
            ['users']
        );

        return $userCatalogues;
    }

    public function create($request)
    {
        DB::beginTransaction();

        try {
            $payload = $request->except(['_token']);
            $user = $this->userCatalogueRepository->create($payload);
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
            $user = $this->userCatalogueRepository->update($id, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    public function updateStatus($post = [])
    {
        DB::beginTransaction();
        try {
            $payload = [];
            $payload[$post['field']] = ($post['value'] == 1) ? 0 : 1;
            $this->userCatalogueRepository->update($post['modelId'], $payload);
            $this->changeStatus($post, $payload[$post['field']]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return false;
        }
    }



    public function updateStatusAll($post = [])
    {
        DB::beginTransaction();
        try {
            $payload[$post['field']] = $post['value'];
            $user = $this->userCatalogueRepository->updateByWhereIn('id', $post['id'], $payload);
            $this->changeStatus($post, $post['value']);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    public function changeStatus($post, $value)
    {
        DB::beginTransaction();
        try {
            $array = [];
            if (isset($post['modelId'])) {
                $array[] = $post['modelId'];
            } else {
                $array = $post['id'];
            }

            $payload[$post['field']] = $post['value'] == 1 ? 0 : 1;
            $this->userRepository->updateByWhereIn('user_catalogue_id', $array, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();
            die();
        }
    }


    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $user = $this->userCatalogueRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    private function paginateSelect()
    {
        return [
            'id',
            'name',
            'description',
            'publish'
        ];
    }
}