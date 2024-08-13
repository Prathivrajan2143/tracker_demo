<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\client\ClientController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\project\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\user\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'guest'], function(){

    Route::view('/login', 'login')->name('login');

    Route::post('/login', [AuthController::class, 'authenticate']);
});

Route::group(['middleware' => 'auth'], function(){

    //Dashboard Route
    Route::view('/home', 'dashboard')->name('dashboard');
    Route::GET('/home', [DashboardController::class, 'index'])->name('dashboard');

    //Store User
    Route::POST('/user', [UserController::class, 'storeUser'])->name('add.user');

    //Create New ROle
    Route::POST('/role', [RoleController::class, 'storeRole'])->name('add.role');

    //Store Client
    Route::POST('/client', [ClientController::class, 'storeClient'])->name('add.client');

    //View Project Blade File to add project
    Route::GET('/project', [ProjectController::class, 'showproject'])->name('show.project');

    //Create Project
    Route::POST('/project', [ProjectController::class, 'storeproject'])->name('add.project');

    //Create Role Form
    Route::GET('/form', [ProjectController::class, 'showRoleForm'])->name('show.role.form');

    //Store Role Form
    Route::POST('/form', [ProjectController::class, 'storeRoleForm'])->name('submit.role.form');
});
