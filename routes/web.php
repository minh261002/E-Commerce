<?php

use App\Http\Controllers\Ajax\LocationController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\AuthController;

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


/*============================== BACKEND ROUTES ==============================*/
Route::get('admin', [AuthController::class, 'index'])->name('auth.admin')->middleware('login');
Route::post('login', [AuthController::class, 'login'])->name('auth.login')->middleware('login');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

/* users */
Route::group(['prefix' => 'user'], function () {
    Route::get('index', [UserController::class, 'index'])->name('user.index')->middleware('auth.admin');
    Route::get('create', [UserController::class, 'create'])->name('user.create')->middleware('auth.admin');
    Route::post('store', [UserController::class, 'store'])->name('user.store')->middleware('auth.admin');
    Route::get('{id}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('auth.admin');
    Route::post('{id}/update', [UserController::class, 'update'])->name('user.update')->middleware('auth.admin');
    Route::get('{id}/delete', [UserController::class, 'delete'])->name('user.delete')->middleware('auth.admin');
    Route::delete('{id}/delete', [UserController::class, 'destroy'])->name('user.destroy')->middleware('auth.admin');
});

/* ajax */
Route::get('ajax/location/index', [LocationController::class, 'getLocation'])->name('ajax.location.index')->middleware('auth.admin');


Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth.admin');
/*============================== BACKEND ROUTES ==============================*/