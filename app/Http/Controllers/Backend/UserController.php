<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
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
        // $users = User::paginate(15);
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
        $config['seo'] = config('app.user');
        return view('backend.dashboard.layouts', compact('layoutContent', 'config', 'provinces'));
    }

    private function config()
    {
        return [
            'js' => [
                'backend/js/plugins/switchery/switchery.js',
            ],
            'css' => [
                'backend/css/plugins/switchery/switchery.css',
            ],
        ];
    }
}