<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        // $users = User::paginate(15);
        $users = $this->userService->paginate();
        $config= $this->config();
        $layoutContent = 'backend.user.index';
        return view('backend.dashboard.layouts', compact('layoutContent', 'config', 'users'));
    }

    private function config(){
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