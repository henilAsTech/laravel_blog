<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('home');
});

Auth::routes();

// user controller for blog
Route::resource('/blog', BlogController::class);


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin', [HomeController::class, 'index'])->name('admin');
Route::get('/profile/{id}', [HomeController::class, 'profile'])->name('profile');
Route::get('/profile-edit/{id}', [HomeController::class, 'editProfile'])->name('edit');
Route::put('/profile-update', [HomeController::class, 'updateProfile'])->name('update');
Route::delete('/profile-delete/{id}', [HomeController::class, 'destroyProfile'])->name('destroy');


// group middleware
Route::group(['middleware' => ['isAdmin']], function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/blog-list', [AdminController::class, 'blogList'])->name('bloglist');
    Route::get('/admin/show-blog/{id}', [AdminController::class, 'showBlog'])->name('showblog');
    Route::get('/admin/blog-create', [AdminController::class, 'blogCreate'])->name('blogcreate');
    Route::post('/admin/blog-store', [AdminController::class, 'blogStore'])->name('blogstore');
    Route::get('/admin/blog-edit/{id}', [AdminController::class, 'blogEdit'])->name('blogedit');
    Route::put('/admin/blog-update', [AdminController::class, 'blogUpdate'])->name('blogupdate');
    Route::delete('/admin/delete-blog/{id}', [AdminController::class, 'blogDestroy'])->name('blogdestroy');

    Route::get('/admin/user-list', [AdminController::class, 'userList'])->name('userlist');
    Route::get('/admin/show-user/{id}', [AdminController::class, 'showUser'])->name('showuser');
    Route::get('/admin/user-create', [AdminController::class, 'userCreate'])->name('usercreate');
    Route::post('/admin/user-store', [AdminController::class, 'userStore'])->name('userstore');
    Route::get('/admin/user-edit/{id}', [AdminController::class, 'userEdit'])->name('useredit');
    Route::put('/admin/user-update', [AdminController::class, 'userUpdate'])->name('userupdate');
    Route::delete('/admin/deleteuser/{id}', [AdminController::class, 'userDestroy'])->name('userdestroy');
});


Route::view('accessdenied', 'accessdenied');
