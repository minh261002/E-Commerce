<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceService;

class UserController extends Controller
{
    protected $userService;
    protected $provinceRepository;

    public function __construct(
        UserService $userService,
        ProvinceService $provinceRepository
    ) {
        $this->userService = $userService;
        $this->provinceRepository = $provinceRepository;
    }

    public function index()
    {
        $users = $this->userService->paginate();
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
        return view('backend.dashboard.layouts', compact('layoutContent', 'config', 'provinces'));
    }

    public function store(StoreUserRequest $request)
    {
        if ($this->userService->create($request)) {
            return redirect()->route('user.index')->with('success', 'Thêm thành viên mới thành công');
        }
        return redirect()->back()->with('error', 'Đã có lỗi xảy ra');
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