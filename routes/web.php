<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\BlogDetailController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\PageContentController;
use App\Http\Controllers\TopicDetailController;
use App\Http\Controllers\CoursedetailController;
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
