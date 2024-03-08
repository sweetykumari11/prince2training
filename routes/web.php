<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\FaqController;
use App\Http\Controllers\admin\TagController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\TopicController;
use App\Http\Controllers\admin\CourseController;
use App\Http\Controllers\admin\ModuleController;
use App\Http\Controllers\admin\RegionController;
use App\Http\Controllers\admin\CountryController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\LocationsController;
use App\Http\Controllers\admin\BlogDetailController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\LogActivityController;
use App\Http\Controllers\admin\PageContentController;
use App\Http\Controllers\admin\TopicDetailController;
use App\Http\Controllers\admin\CoursedetailController;
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
Route::prefix('admin')->group(function () {
    Route::get('/login',        [AuthController::class, 'index'])->name('login');
    Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom');
    Route::post('logout',       [AuthController::class, 'logout'])->name('logout');

    // Password Reset Routes
    Route::get('/password/reset/{id}', [UserController::class, 'Reset'])->name('password.reset');
    Route::get('/reset-password/{id}', [UserController::class, 'showResetForm'])->name('reset.password');
    Route::post('/change-password', [UserController::class, 'changepassword'])->name('password.change');

    Route::group(['middleware' => ['auth:web']], function () {

        Route::get('dashboard',     [HomeController::class, 'index'])->name('dashboard.index');
        Route::resource('user',            UserController::class);
        Route::resource('role',            RoleController::class);
        Route::resource('module',          ModuleController::class);
        Route::resource('permission',      PermissionController::class);
        Route::resource('pagecontent',      PageContentController::class);
        Route::resource('blogs',            BlogController::class);
        Route::resource('tag',              TagController::class);
        Route::resource('course',           CourseController::class);
        Route::resource('countries',              CountryController::class);
        Route::resource('category',         CategoryController::class);
        Route::resource('region', RegionController::class);
        Route::resource('locations', LocationsController::class);
        Route::resource('blogs.blogDetail',         BlogDetailController::class);
        Route::resource('topic',            TopicController::class);
        Route::resource('topic.faqs',               FaqController::class);
        Route::resource('topic.topicdetails',       TopicDetailController::class);
        Route::resource('course.coursedetails',     CoursedetailController::class);
        Route::resource('course.faqs',              FaqController::class);
        Route::post('rolesupdate',       [UserController::class, 'rolesupdate'])->name('user.rolesupdate');
        Route::get('actvities', [LogActivityController::class, 'index'])->name('actvities.index');


        // Route::get('changeblogStatus',        [BlogController::class, 'blogStatus']);
        // Route::get('changecountryStatus',        [CountryController::class, 'countryStatus']);
        // Route::get('blogsetpopular', [BlogController::class, 'setPopular']);
        // Route::get('changecategoryStatus',    [CategoryController::class, 'categoryStatus']);
        // Route::get('changefaqStatus',         [FaqController::class, 'faqStatus']);
        // Route::get('changetopicStatus',       [TopicController::class, 'updateStatus']);
        // Route::get('country-topics',        [TopicController::class, 'storeTopicCountry']);
        // Route::get('topicsetpopular',       [TopicController::class, 'setPopular']);
    });
});
