<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::controller(Auth::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/signup', 'signup');
    Route::delete('/logout', 'logout');
});

Route::apiResources([
    'components' => ComponentController::class,
    'computers' => ComputerController::class,
]);

Route::apiResource('/orders', OrderController::class)
    ->except('destroy');

Route::apiResource('/users', UserController::class)
    ->only('index', 'update');
