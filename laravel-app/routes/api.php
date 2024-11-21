<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\DestinationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbacksController;
use App\Http\Controllers\HostingController;
use App\Http\Controllers\LevelUserController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\TripsController;
use App\Models\Destination;
use App\Models\Hosting;
use App\Models\LevelUser;
use App\Models\Packages;
use App\Models\Reservations;
use App\Models\Tour;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('feedbacks')->group(function () {
    Route::get('/', [FeedbacksController::class, 'index']);
    Route::post('/', [FeedbacksController::class, 'store']);
    Route::get('/{feedbacks}', [FeedbacksController::class, 'show']);
    Route::put('/{feedbacks}', [FeedbacksController::class, 'update']);
    Route::delete('/{feedbacks}', [FeedbacksController::class, 'destroy']);
});

Route::prefix('destination')->group(function () {
    Route::get('/', [DestinationController::class, 'index']);
    Route::post('/', [DestinationController::class, 'store']);
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

Route::prefix('levelUser')->group(function () {
    Route::get('/', [LevelUserController::class, 'index']);
    Route::post('/', [LevelUserController::class, 'store']);
    Route::get('/{levelUser}', [LevelUserController::class, 'show']);
    Route::put('/{levelUser}', [LevelUserController::class, 'update']);
    Route::delete('/{levelUser}', [LevelUserController::class, 'destroy']);
});

Route::prefix('reservations')->group(function () {
    Route::get('/', [ReservationsController::class, 'index']);
    Route::post('/', [ReservationsController::class, 'store']);
    Route::get('/{reservations}', [ReservationsController::class, 'show']);
    Route::put('/{reservations}', [ReservationsController::class, 'update']);
    Route::delete('/{reservations}', [ReservationsController::class, 'destroy']);
});

Route::prefix('tour')->group(function () {
    Route::get('/', [TourController::class, 'index']);
    Route::post('/', [TourController::class, 'store']);
    Route::get('/{tour}', [TourController::class, 'show']);
    Route::put('/{tour}', [TourController::class, 'update']);
    Route::delete('/{tour}', [TourController::class, 'destroy']);
});

Route::prefix('transport')->group(function () {
    Route::get('/', [TransportController::class, 'index']);
    Route::post('/', [TransportController::class, 'store']);
    Route::get('/{transport}', [TransportController::class, 'show']);
    Route::put('/{transport}', [TransportController::class, 'update']);
    Route::delete('/{transport}', [TransportController::class, 'destroy']);
});

Route::prefix('trips')->group(function () {
    Route::get('/', [TripsController::class, 'index']);
    Route::post('/', [TripsController::class, 'store']);
    Route::get('/{trips}', [TripsController::class, 'show']);
    Route::put('/{trips}', [TripsController::class, 'update']);
    Route::delete('/{trips}', [TripsController::class, 'destroy']);
});


