<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DTRController;
use App\Http\Controllers\Api\GeoController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AbsentController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\api\ProgramController;
use App\Http\Controllers\Api\FaceDataController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\api\SchoolYearController;
use App\Http\Controllers\Api\DTRLocationController;
use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\EstablishmentController;
use App\Http\Controllers\Api\AccomplishmentController;

# GET USER
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
# USER REGISTER
Route::post('user/register', [UserController::class, 'registerUser']);

# USER LOGIN
Route::post('user/login', [UserController::class, 'login']);
# ADMIN LOGIN
Route::post('admin/login', [AdminController::class, 'login']);
# ADMIN CREATE
Route::post('admin/register', [AdminController::class, 'register']);

# GEOLOCATOR
Route::post('geodata', [GeoController::class, 'getGeoData']);
# NEARBY PLACES
Route::post('places', [GeoController::class, 'getNearbyPlaces']);


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
# PROGRAM
Route::apiResource('program', ProgramController::class);
# DTR 
Route::apiResource('dtr', DTRController::class);
# DTR - LOCATION
Route::apiResource('dtr-location', DTRLocationController::class);
# SCHOOL YEAR
Route::apiResource('school_year', SchoolYearController::class);
# REPORT
Route::apiResource('report', ReportController::class);
Route::post('report/count', [ReportController::class, 'report']);
Route::post('report/outside', [ReportController::class, 'outsideRange']);




# FACE DATA
Route::apiResource('facedata', FaceDataController::class);






