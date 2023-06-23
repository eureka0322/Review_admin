<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CompanyController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Profile Routes
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function(){
    Route::get('/', [HomeController::class, 'getProfile'])->name('detail');
    Route::post('/update', [HomeController::class, 'updateProfile'])->name('update');
    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
});

// Roles
Route::resource('roles', App\Http\Controllers\RolesController::class);

// Permissions
Route::resource('permissions', App\Http\Controllers\PermissionsController::class);

// Users 
Route::middleware('auth')->prefix('users')->name('users.')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('destroy');
    Route::get('/update/status/{user_id}/{status}', [UserController::class, 'updateStatus'])->name('status');

    
    Route::get('/import-users', [UserController::class, 'importUsers'])->name('import');
    Route::post('/upload-users', [UserController::class, 'uploadUsers'])->name('upload');

    Route::get('export/', [UserController::class, 'export'])->name('export');

});

Route::middleware('auth')->prefix('review')->name('review.')->group(function(){
    Route::get('/', [ReviewController::class, 'index'])->name('index');
    Route::get('/create', [ReviewController::class, 'create'])->name('create');
    // Route::post('/store', [ReviewController::class, 'store'])->name('store');
    Route::get('/edit/{review}', [ReviewController::class, 'edit'])->name('edit');
    // Route::put('/update/{user}', [ReviewController::class, 'update'])->name('update');
    Route::delete('/delete/{review}', [ReviewController::class, 'delete'])->name('destroy');
    Route::get('/update/status/{review_id}/{status}', [ReviewController::class, 'updateStatus'])->name('status');    
});

Route::middleware('auth')->prefix('company')->name('company.')->group(function(){
    Route::get('/', [CompanyController::class, 'index'])->name('index');
    Route::get('/create', [CompanyController::class, 'create'])->name('create');
    Route::post('/store', [CompanyController::class, 'store'])->name('store');
    Route::get('/edit/{company}', [CompanyController::class, 'edit'])->name('edit');
    Route::put('/update/{company}', [CompanyController::class, 'update'])->name('update');
    Route::delete('/delete/{company}', [CompanyController::class, 'delete'])->name('destroy');
});

Route::post('cities', [CompanyController::class, 'getCities'])->name('get.cities');