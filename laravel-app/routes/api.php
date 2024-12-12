<?php

use App\Http\Controllers\Api\AccommodationController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\TripPackagesController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DestinationController;
use App\Http\Middleware\adminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FeedbacksController;
use App\Http\Controllers\Api\HostingController;
use App\Http\Controllers\LevelUserController;
use App\Http\Controllers\Api\TourController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->get('users',[UserController::class, 'index'])->middleware(adminUser::class);


Route::prefix('feedbacks')->group(function () {
    Route::get('/', [FeedbacksController::class, 'index']);
    Route::post('/', [FeedbacksController::class, 'store']);
    Route::get('/{feedbacks}', [FeedbacksController::class, 'show']);
    Route::put('/{feedbacks}', [FeedbacksController::class, 'update']);
    Route::delete('/{feedbacks}', [FeedbacksController::class, 'destroy']);
});

Route::prefix('destination')->group(function () {
    Route::get('/', [DestinationController::class, 'index']);
    Route::middleware(['auth:sanctum'])->post('/', [DestinationController::class, 'store'])->middleware(adminUser::class);
    Route::get('/{destination}', [DestinationController::class, 'show']);
    Route::put('/{destination}', [DestinationController::class, 'update']);
    Route::delete('/{destination}', [DestinationController::class, 'destroy']);
});

Route::prefix('hosting')->group(function () {
    Route::get('/', [HostingController::class, 'index']);
    Route::post('/', [HostingController::class, 'store']);
    Route::get('/{hosting}', [HostingController::class, 'show']);
    Route::put('/{hosting}', [HostingController::class, 'update']);
    Route::delete('/{hosting}', [HostingController::class, 'destroy']);
});

Route::prefix('accommodation')->group(function () {
    Route::get('/{hosting}',[HostingController::class,'index']);
    //Route::get('/{accommodation}',[AccommodationController::class,'show']);
    Route::put('/{accomodation}',[AccommodationController::class,'update']);
    Route::post('/',[AccommodationController::class,'store']);
    Route::delete('/{accomodation}', [AccommodationController::class,'destroy']);
});

Route::prefix('levelUser')->group(function () {
    Route::get('/', [LevelUserController::class, 'index']);
    Route::post('/', [LevelUserController::class, 'store']);
    Route::get('/{levelUser}', [LevelUserController::class, 'show']);
    Route::put('/{levelUser}', [LevelUserController::class, 'update']);
    Route::delete('/{levelUser}', [LevelUserController::class, 'destroy']);
});

Route::prefix('reservation')->group(function () {
    Route::get('/', [ReservationController::class, 'index']);
    Route::post('/', [ReservationController::class, 'store']);
    Route::get('/{reservations}', [ReservationController::class, 'show']);
    Route::put('/{reservations}', [ReservationController::class, 'update']);
    Route::delete('/{reservations}', [ReservationController::class, 'destroy']);
});

Route::prefix('tour')->group(function () {
    Route::get('/', [TourController::class, 'index']);
    Route::post('/', [TourController::class, 'store']);
    Route::get('/{tour}', [TourController::class, 'show']);
    Route::put('/{tour}', [TourController::class, 'update']);
    Route::delete('/{tour}', [TourController::class, 'destroy']);
});


Route::prefix('packages')->group(function () {
    Route::get('/', [TripPackagesController::class, 'index']);
    Route::post('/', [TripPackagesController::class, 'store']);
    Route::get('/{trips}', [TripPackagesController::class, 'show']);
    Route::put('/{trips}', [TripPackagesController::class, 'update']);
    Route::delete('/{trips}', [TripPackagesController::class, 'destroy']);
});

