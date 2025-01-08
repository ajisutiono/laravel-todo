<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyMemberMiddleware;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'home']);



Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'login')->middleware('onlyGuest')->name('login');
    Route::post('/login', 'doLogin')->middleware('onlyGuest');
    Route::post('/logout', 'doLogout')->middleware('onlyMember')->name('logout');
});

Route::controller(TodoController::class)->middleware(OnlyMemberMiddleware::class)
    ->group(function () {
        Route::get('/todo', 'todoList');
    }); 