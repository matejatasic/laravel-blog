<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;

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

// Posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
