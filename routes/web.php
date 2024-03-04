<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\BlogDetailController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PageContentController;
use App\Http\Controllers\TagController;
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


Route::get('/',             [AuthController::class, 'index'])->name('login');
Route::get('/login',        [AuthController::class, 'index'])->name('login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom');
Route::post('logout',       [AuthController::class, 'logout'])->name('logout');
Route::get('dashboard',     [HomeController::class, 'index'])->name('dashboard.index');

Route::resource('user',            UserController::class);
Route::resource('role',            RoleController::class);
Route::resource('module',          ModuleController::class);
Route::resource('permission',      PermissionController::class);
Route::resource('pagecontent',      PageContentController::class);
Route::resource('blogs',            BlogController::class);
Route::resource('tag',              TagController::class);
Route::resource('countries',              CountryController::class);

Route::resource('blogs.blogDetail',         BlogDetailController::class);


Route::get('changeblogStatus',        [BlogController::class, 'blogStatus']);
Route::get('changecountryStatus',        [CountryController::class, 'countryStatus']);

Route::get('blogsetpopular', [BlogController::class, 'setPopular']);

// Password Reset Routes
Route::get('/password/reset/{id}', [UserController::class, 'Reset'])->name('password.reset');

Route::get('/reset-password/{id}', [UserController::class, 'showResetForm'])->name('reset.password');

Route::post('/change-password', [UserController::class, 'changepassword'])->name('password.change');



