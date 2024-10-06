<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GeoController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AbsentController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\EstablishmentController;
use App\Http\Controllers\Api\AccomplishmentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

# USER LOGIN
Route::post('user/login', [UserController::class, 'login']);
# ADMIN LOGIN
Route::post('admin/login', [AdminController::class, 'login']);
# ADMIN CREATE
Route::post('admin/register', [AdminController::class, 'register']);

# ANNOUNCEMENT - RESOURCE
Route::apiResource('announcement', AnnouncementController::class);
# ESTABLISMENT - RESOURCE
Route::apiResource('establishment', EstablishmentController::class);
# ACCOMPLISHMENT
Route::apiResource('accomplishment', AccomplishmentController::class);
# SCHEDULE
Route::apiResource('schedule', ScheduleController::class);
# ABSENT
Route::apiResource('absent', AbsentController::class);


# GEOLOCATOR
Route::post('geodata', [GeoController::class, 'getGeoData']);




