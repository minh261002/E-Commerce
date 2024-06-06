<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceService;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

class UserController extends Controller
{
    protected $userService;
    protected $provinceRepository;
    protected $userRepository;

    public function __construct(
        UserService $userService,
        ProvinceService $provinceRepository,
        UserRepository $userRepository
    ) {
        $this->userService = $userService;
        $this->provinceRepository = $provinceRepository;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $users = $this->userService->paginate($request);
        $config = $this->config();
        $config['seo'] = config('app.user');
        $layoutContent = 'backend.user.index';
        return view('backend.dashboard.layouts', compact('layoutContent', 'config', 'users'));
    }

    public function create()
    {
        $provinces = $this->provinceRepository->all();
        $layoutContent = 'backend.user.create';
        $config = $this->config();
        $config['seo'] = config('app.user');
        $config['method'] = 'create';
        return view('backend.dashboard.layouts', compact('layoutContent', 'config', 'provinces'));
    }

    public function store(StoreUserRequest $request)
    {
        if ($this->userService->create($request)) {
            return redirect()->route('user.index')->with('success', 'Thêm thành viên mới thành công');
        }
        return redirect()->back()->with('error', 'Đã có lỗi xảy ra');
    }

    public function edit($id)
    {
        $user = $this->userRepository->findById($id);
        $provinces = $this->provinceRepository->all();

        $config = $this->config();
        $config['seo'] = config('app.user');
        $config['method'] = 'edit';

        $layoutContent = 'backend.user.create';

        return view('backend.dashboard.layouts', compact('layoutContent', 'config', 'provinces', 'user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        if ($this->userService->update($id, $request)) {
            return redirect()->route('user.index')->with('success', 'Cập nhật thành viên thành công');
        }

        return redirect()->back()->with('error', 'Đã có lỗi xảy ra, vui lòng thử lại sau');
    }

    public function delete(Request $request, $id)
    {
        $user = $this->userRepository->findById($id);
        $config = $this->config();
        $config['seo'] = config('app.user');

        $layoutContent = 'backend.user.delete';

        return view('backend.dashboard.layouts', compact('layoutContent', 'config', 'user'));
    }

    public function destroy(Request $request, $id)
    {
        if ($this->userService->delete($id)) {
            return redirect()->route('user.index')->with('success', 'Xóa thành viên thành công');
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