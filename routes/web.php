<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentLikeController;

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

// Pages
Route::get('/', [PageController::class, 'getHome'])->name('pages.home');
Route::get('/about', [PageController::class, 'getAbout'])->name('pages.about');
Route::get('/contact', [PageController::class, 'getContact'])->name('pages.contact');

// Login & Registration
Route::get('/login', [AuthController::class, 'getLogin'])->name('getLogin');
Route::get('/register', [AuthController::class, 'getRegister'])->name('getRegister');
Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');
Route::get('/logout', [AuthController::class, 'postLogout'])->name('logout');

// Admin
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/users', [AdminController::class, 'getUsers'])->name('admin.users');
Route::get('/admin/posts', [AdminController::class, 'getPosts'])->name('admin.posts');
Route::get('/admin/comments', [AdminController::class, 'getComments'])->name('admin.comments');
Route::get('/admin/categories', [AdminController::class, 'getCategories'])->name('admin.categories');
Route::get('/admin/tags', [AdminController::class, 'getTags'])->name('admin.tags');
Route::get('/admin/likes', [AdminController::class, 'getLikes'])->name('admin.likes');
Route::get('/admin/posts/{id}', [AdminController::class, 'showPost']);

// Posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::group(['middleware' => 'auth'], function() {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

//Comments
Route::get('/comments/{id}/create', [CommentController::class, 'create'])->name('comments.create');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::post('/comments/{comment}/likes', [CommentLikeController::class, 'store'])->name('comments.likes');
Route::delete('/comments/{comment}/likes', [CommentLikeController::class, 'destroy'])->name('comments.likes');
