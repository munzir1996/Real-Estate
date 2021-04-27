<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\UserAuthController;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\RegionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('register', [UserAuthController::class, 'register'])->name('api.register');

Route::middleware('auth:sanctum')->group(function () {
    Route::put('profile', [UserAuthController::class, 'updateProfile'])->name('api.profile.update');
    Route::post('login', [UserAuthController::class, 'login'])->name('api.login');
    Route::post('logout', [UserAuthController::class, 'logout'])->name('api.logout');
});

Route::apiResource('regions', RegionController::class);
Route::apiResource('cities', CityController::class);




