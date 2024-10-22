<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::controller(UserController::class)->group(function(){
    Route::post('user', 'register');
    Route::post('user', 'login');
});

Route::middleware('auth:sanctum')->group( function () {
});
