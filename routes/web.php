<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Blogger\BloggerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\Blogger\BloggerDashboardController;
use App\Http\Controllers\Admin\Activity;
use App\Http\Controllers\Blogger\BloggerGuidelinesController;

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

Route::get('/', [BlogsController::class, 'blogsforwelcome'])->name('welcome');
// Route::get('/', [BlogsController::class, 'categoriesForWelcome'])->name('welcome');

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [BloggerDashboardController::class, 'dashboard'])->name('home');
});



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
        Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
        Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');

        Route::get('/blogs', [AdminBlogController::class, 'index'])->name('blogs.index');

        Route::get('/blogs/{blog}/revoke', [AdminBlogController::class, 'revokeForm'])->name('blogs.revoke.form');

        Route::post('/blogs/{blog}/revoke/send', [AdminBlogController::class, 'revokeSend'])->name('blogs.revoke.send');

        Route::delete('/blogs/{blog}', [AdminBlogController::class, 'destroy'])->name('blogs.destroy');

        Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
        Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
        Route::put('/blogs/{blog}/pending',[AdminBlogController::class, 'moveToPending'])->name('blogs.pending');


    });

Route::prefix('blogger')->name('blogger.')->group(function () {
    Route::get('/blog', [BloggerController::class, 'index'])->name('bloggers.index');
    Route::get('/blog/create', [BloggerController::class, 'create'])->name('bloggers.create');
    Route::post('/blogs', [BloggerController::class, 'store'])->name('bloggers.store');
    Route::get('/blogs/{blog}/edit', [BloggerController::class, 'edit'])->name('bloggers.edit');
    Route::put('/blogs/{blog}', [BloggerController::class, 'update'])->name('bloggers.update');
    Route::delete('/blogs/{blog}', [BloggerController::class, 'destroy'])->name('bloggers.destroy');
    Route::get('blogs/pending', [BloggerController::class, 'pending'])->name('bloggers.pending');
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




    // ROUTES FOR PROFILE PICTURE AND CHANGE OF NAME

    Route::middleware(['auth'])->group(function () {

        // BLOGGER
        Route::view('/blogger/profile', 'bloggers.profile.account')->name('bloggers.profile.account');
        Route::post('/blogger/profile/account', [ProfileController::class, 'updateAccount'])->name('blogger.profile.account');
        Route::post('/blogger/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('blogger.profile.avatar');
        Route::delete('/profile/delete', [ProfileController::class, 'deleteProfile'])->name('profile.delete');

        // ADMIN
        Route::view('/admin/profile', 'admin.profile.account')->name('admin.profile.account');
        Route::view('/admin/password', 'admin.changeofpassword.dob')->name('admin.changeofpassword.dob');
        Route::view('/blogger/password', 'bloggers.changeofpassword.dob')->name('bloggers.changeofpassword.dob');
        
        Route::post('/admin/profile/account', [ProfileController::class, 'updateAccount'])->name('admin.profile.update');
        Route::post('/admin/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('admin.profile.avatar');

    });

    // ROUTES FOR SETTINGS

    Route::view('admin/settings', 'admin.settings.settings')->name('admin.settings.settings');
    Route::view('blogger/settings', 'bloggers.settings.settings')->name('bloggers.settings.settings');

Route::post('/profile/focus', [ProfileController::class, 'updateFocus'])
    ->name('blogger.profile.focus');

// BLOGGERS GUIDELINES

Route::get('/blogger/guidelines', [BloggerGuidelinesController::class, 'index'])->name('blogger.guidelines.guidelines');
