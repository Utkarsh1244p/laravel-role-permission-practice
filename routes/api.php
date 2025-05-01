<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix'=> 'users'], function () {
    Route::post('/{user}/assign-role', [UserController::class, 'assignRole']);
    Route::get('/{user}/roles', [UserController::class, 'getUserRole']);
});

Route::get('roles', [UserController::class, 'getRoles']);