<?php

namespace App\Services;

use App\Services\Interfaces\UserCatalogueServiceInterface;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class UserService
 * @package App\Services
 */
class UserCatalogueService implements UserCatalogueServiceInterface
{
    public function __construct(
        protected UserCatalogueRepository $userCatalogueRepository
    ) {
        $this->userCatalogueRepository = $userCatalogueRepository;
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
            $payload[$post['field']] = ($post['value'] == 1) ? 0 : 1;
            $user = $this->userCatalogueRepository->update($post['modelId'], $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    public function updateStatusAll($post = [])
    {
        DB::beginTransaction();
        try {
            $payload[$post['field']] = $post['value'];
            $user = $this->userCatalogueRepository->updateByWhereIn('id', $post['id'], $payload);
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
        ];
    }
}
