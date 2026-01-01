<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Blogger\BloggerController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// ROUTES FOR GOOGLE CONTROLLER

Route::get('login/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback']);

//ROUTE FOR ADMIN DASHBOARD

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');
    });



// ROUTE FOR ADMIN BLOG

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
        Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
        Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');

        Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
        Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
        Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
    });

Route::prefix('blogger')->name('blogger.')->group(function () {
    Route::get('/blog', [BloggerController::class, 'index'])->name('bloggers.index');
    Route::get('/blog/create', [BloggerController::class, 'create'])->name('bloggers.create');
    Route::post('/blogs', [BloggerController::class, 'store'])->name('bloggers.store');
    Route::get('/blogs/{blog}/edit', [BloggerController::class, 'edit'])->name('bloggers.edit');
    Route::put('/blogs/{blog}', [BloggerController::class, 'update'])->name('bloggers.update');
    Route::delete('/blogs/{blog}', [BloggerController::class, 'destroy'])->name('bloggers.destroy');
});



// ROUTES FOR VIEW BLOGGERS ACCOUNTS
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('users.index');

        Route::post('/users/{user}/toggle', [AdminUserController::class, 'toggleStatus'])
            ->name('users.toggle');

        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])
            ->name('users.destroy');
});


// ROUTES FOR ADMIN BLOGS

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('/blogs/pending', [AdminBlogController::class, 'pending'])->name('blogs.pending');

        Route::post('/blogs/{blog}/approve', [AdminBlogController::class, 'approve'])->name('blogs.approve');

        Route::post('/blogs/{blog}/revoke', [AdminBlogController::class, 'revoke'])->name('blogs.revoke');
});

// ROUTES FOR ADMIN DASHBOARD

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
        Route::get('/activities/latest', [AdminDashboardController::class, 'latestActivities'])
            ->name('activities.latest');
    });


