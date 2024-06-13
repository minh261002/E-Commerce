<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserCatalogueRequest;
use App\Http\Requests\UpdateUserCatalogueRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserCatalogueServiceInterface as UserCatalogueService;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;

class UserCatalogueController extends Controller
{
    protected $userCatalogueService;
    protected $userCatalogueRepository;

    public function __construct(
        UserCatalogueService $userCatalogueService,
        UserCatalogueRepository $userCatalogueRepository
    ) {
        $this->userCatalogueService = $userCatalogueService;
        $this->userCatalogueRepository = $userCatalogueRepository;
    }

    public function index(Request $request)
    {
        $userCatalogues = $this->userCatalogueService->paginate($request);
        $config = $this->config();
        $config['seo'] = config('app.user_catalogue');
        $layoutContent = 'backend.user.catalogue.index';
        return view('backend.dashboard.layouts', compact('layoutContent', 'config', 'userCatalogues'));
    }

    public function create()
    {
        $layoutContent = 'backend.user.catalogue.create';
        $config = $this->config();
        $config['seo'] = config('app.user_catalogue');
        $config['method'] = 'create';

        return view('backend.dashboard.layouts', compact('layoutContent', 'config'));
    }

    public function store(StoreUserCatalogueRequest $request)
    {
        if ($this->userCatalogueService->create($request)) {
            return redirect()->route('user.catalogue.index')->with('success', 'Thêm nhóm thành viên thành công');
        }

        return redirect()->back()->with('error', 'Đã có lỗi xảy ra, vui lòng thử lại sau');
    }

    public function edit($id)
    {
        $userCatalogue = $this->userCatalogueRepository->findById($id);

        $config = $this->config();
        $config['seo'] = config('app.user_catalogue');
        $config['method'] = 'edit';

        $layoutContent = 'backend.user.catalogue.create';

        return view('backend.dashboard.layouts', compact('layoutContent', 'config', 'userCatalogue'));
    }

    public function update(UpdateUserCatalogueRequest $request, $id)
    {
        if ($this->userCatalogueService->update($id, $request)) {
            return redirect()->route('user.catalogue.index')->with('success', 'Cập nhật thành viên thành công');
        }

        return redirect()->back()->with('error', 'Đã có lỗi xảy ra, vui lòng thử lại sau');
    }

    public function delete(Request $request, $id)
    {
        $user = $this->userCatalogueRepository->findById($id);
        $config = $this->config();
        $config['seo'] = config('app.user_catalogue');

        $layoutContent = 'backend.user.catalogue.delete';

        return view('backend.dashboard.layouts', compact('layoutContent', 'config', 'user'));
    }

    public function destroy(Request $request, $id)
    {
        if ($this->userCatalogueService->delete($id)) {
            return redirect()->route('user.index')->with('success', 'Xóa nhóm thành viên thành công');
        }
    }

    private function config()
    {
        return [
            'js' => [
                'backend/js/plugins/switchery/switchery.js',
                'backend/library/library.js',
                'backend/library/location.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
            ],
            'css' => [
                'backend/css/plugins/switchery/switchery.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
        ];
    }
}