<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::resource('users', UserController::class);
Route::middleware('auth:sanctum')->group( function () {
});
