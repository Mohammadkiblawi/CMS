<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\PostController as AdminPostController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'index']);

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('post', PostController::class)->except('index')->middleware('verified');;
Route::get('{id}/{slug}', [PostController::class, 'getByCategory'])->name('category')->where('id', '[0-9]'); //to not affect on the other route
Route::post('/search', [PostController::class, 'search'])->name('search');
Route::resource('comment', CommentController::class);
Route::get('user/{id}', [ProfileController::class, 'getByUser'])->name('profile'); //on this route
Route::get('user/{id}/comments', [ProfileController::class, 'getCommentsByUser']);
Route::get('settings', [ProfileController::class, 'Settings'])->name('settings');
Route::post('settings', [ProfileController::class, 'UpdateProfile'])->name('settings');
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('Admin');
Route::middleware('Admin')->prefix('admin')->group(function () {
    Route::resource('posts', AdminPostController::class);
    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions');
    Route::post('permissions', [RoleController::class, 'store'])->name('permissions');
});
Route::post('permission/byRole', [RoleController::class, 'getByRole'])->name('permission_byRole')->middleware('Admin');
Route::resource('page', PageController::class);
