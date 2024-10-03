<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AnnouncementController;

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

