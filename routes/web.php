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
Route::group(['middleware' => 'guest'], function() {
    Route::get('/login', [AuthController::class, 'getLogin'])->name('getLogin');
    Route::get('/register', [AuthController::class, 'getRegister'])->name('getRegister');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');
    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/forgot-password', [AuthController::class, 'sendEmail'])->name('sendEmail');
    Route::get('/change-password/{token}', [AuthController::class, 'changePassword'])->name('changePassword');
    Route::put('/change-password', [AuthController::class, 'updatePassword'])->name('updatePassword');
});
Route::get('/logout', [AuthController::class, 'postLogout'])->middleware('auth')->name('logout');

// Admin
Route::group(['middleware' => 'admin'], function() {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Users
    Route::get('/admin/users', [AdminController::class, 'getUsers'])->name('admin.users');
    Route::put('/admin/users/ban', [AdminController::class, 'banUser'])->name('admin.banUser');
    Route::put('/admin/users/unban', [AdminController::class, 'unbanUser'])->name('admin.unbanUser');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');

    // Posts
    Route::get('/admin/posts', [AdminController::class, 'getPosts'])->name('admin.posts');
    Route::post('/admin/posts/approve', [AdminController::class, 'approvePost'])->name('admin.approvePost');
    Route::get('/admin/posts/{id}', [AdminController::class, 'showPost']);
    Route::delete('/admin/posts/{id}', [AdminController::class, 'deletePost'])->name('admin.deletePost');

    // Comments
    Route::get('/admin/comments', [AdminController::class, 'getComments'])->name('admin.comments');
    Route::post('/admin/comments/approve', [AdminController::class, 'approveComment'])->name('admin.approveComment');
    Route::get('/admin/comments/{id}', [AdminController::class, 'editComment']);
    Route::put('/admin/comments/{id}', [AdminController::class, 'updateComment'])->name('admin.editComment');
    Route::delete('/admin/comments/{id}', [AdminController::class, 'deleteComment'])->name('admin.deleteComment');
    
    // Categories
    Route::get('/admin/categories', [AdminController::class, 'getCategories'])->name('admin.categories');
    Route::post('/admin/categories/create', [AdminController::class, 'createCategory'])->name('admin.createCategory');
    Route::get('/admin/categories/{id}', [AdminController::class, 'editCategory']);
    Route::put('/admin/categories/{id}', [AdminController::class, 'updateCategory'])->name('admin.editCategory');
    Route::delete('/admin/categories/{id}', [AdminController::class, 'deleteCategory'])->name('admin.deleteCategory');
    
    // Tags
    Route::get('/admin/tags', [AdminController::class, 'getTags'])->name('admin.tags');
    Route::post('/admin/tags/create', [AdminController::class, 'createTag'])->name('admin.createTag');
    Route::get('/admin/tags/{id}', [AdminController::class, 'editTag']);
    Route::put('/admin/tags/{id}', [AdminController::class, 'updateTag'])->name('admin.editTag');
    Route::delete('/admin/tags/{id}', [AdminController::class, 'deleteTag'])->name('admin.deleteTag');
    
    // Likes
    Route::get('/admin/likes', [AdminController::class, 'getLikes'])->name('admin.likes');
});

// Posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/category/{id}', [PostController::class, 'index'])->name('posts.category-index');
Route::group(['middleware' => 'auth'], function() {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

//Comments
Route::group(['middleware' => 'auth'], function() {
    Route::get('/comments/{id}/create', [CommentController::class, 'create'])->name('comments.create');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/comments/{comment}/likes', [CommentLikeController::class, 'store'])->name('comments.likes');
    Route::delete('/comments/{comment}/likes', [CommentLikeController::class, 'destroy'])->name('comments.likes');
});
