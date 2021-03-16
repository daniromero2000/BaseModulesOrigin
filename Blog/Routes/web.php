<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\ImageUploadsController;
use Modules\Blog\Http\Controllers\LoginController;
use Modules\Blog\Http\Controllers\PagesController;
use Modules\Blog\Http\Controllers\PostsController;
use Modules\Blog\Http\Controllers\SPAViewController;
use Modules\Blog\Http\Controllers\TagsController;
use Modules\Blog\Http\Controllers\TeamController;

// use Modules\Blog\Http\Controllers\ForgotPasswordController;
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

Route::group(['prefix' => 'admin', 'middleware' => ['employee'], 'as' => 'admin.'], function () {
    Route::namespace('Admin')->group(function () {
        Route::get('blog', 'BlogController@index')->name('blog');
        Route::get('blog/posts', 'BlogController@index')->name('blog.post');
        Route::get('blog/posts/new', 'BlogController@index')->name('blog.post.new');
        Route::get('blog/posts/{slug}', 'BlogController@index');

        Route::get('blog/tags', 'BlogController@index')->name('blog.tag');
        Route::get('blog/tags/new', 'BlogController@index')->name('blog.tag.new');
        Route::get('blog/tags/{slug}', 'BlogController@index');
    });
});

Route::prefix('blog')->group(function () {
    Route::get('/', 'BlogController@index')->name('blog');
    Route::get('/post/{slug}', 'BlogController@show')->name('blog.show');
    Route::get('/tag/{slug}', 'BlogController@tagShow')->name('blog.tag.show');
});

Route::prefix('wink')->group(function () {
    Route::get('/api/posts', [PostsController::class, 'index'])->name('posts.index');
    Route::get('/api/posts/{id?}', [PostsController::class, 'show'])->name('posts.show');
    Route::post('/api/posts/{id}', [PostsController::class, 'store'])->name('posts.store');
    Route::delete('/api/posts/{id}', [PostsController::class, 'delete'])->name('posts.delete');

    // Blog Tags...
    Route::get('/api/tags', [TagsController::class, 'index'])->name('tags.index');
    Route::get('/api/tags/{id?}', [TagsController::class, 'show'])->name('tags.show');
    Route::post('/api/tags/{id}', [TagsController::class, 'store'])->name('tags.store');
    Route::delete('/api/tags/{id}', [TagsController::class, 'delete'])->name('tags.delete');

    // Blog Authors...
    Route::get('/api/team', [TeamController::class, 'index'])->name('team.index');
    Route::get('/api/team/{id?}', [TeamController::class, 'show'])->name('team.show');
    Route::post('/api/team/{id}', [TeamController::class, 'store'])->name('team.store');
    Route::delete('/api/team/{id}', [TeamController::class, 'delete'])->name('team.delete');

    // Blog Image Uploads
    Route::post('/api/uploads', [ImageUploadsController::class, 'upload'])->name('images.store');

    // Blog Pages...
    Route::get('/api/pages', [PagesController::class, 'index'])->name('pages.index');
    Route::get('/api/pages/{id?}', [PagesController::class, 'show'])->name('pages.show');
    Route::post('/api/pages/{id}', [PagesController::class, 'store'])->name('pages.store');
    Route::delete('/api/pages/{id}', [PagesController::class, 'delete'])->name('pages.delete');

    // Logout Route...
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.login');
    Route::post('/login', [LoginController::class, 'login'])->name('auth.attempt');

    Route::get('/password/forgot', [ForgotPasswordController::class, 'showResetRequestForm'])->name('password.forgot');
    Route::post('/password/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ForgotPasswordController::class, 'showNewPassword'])->name('password.reset');
});