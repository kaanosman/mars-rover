<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PlateauController;
use App\Http\Controllers\Api\V1\RoverController;
use App\Http\Controllers\Api\V1\RoverStateController;


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

Route::prefix('v1')->group(function () {
    Route::post('plateau', [PlateauController::class, 'store']);
    Route::get('plateau/{id}', [PlateauController::class, 'show']);
    Route::post('rover', [RoverController::class, 'store']);
    Route::get('rover/{id}', [RoverController::class, 'show']);
    Route::post('rover-state', [RoverStateController::class, 'move']);
    Route::get('rover-state/{rover_id}', [RoverStateController::class, 'show']);
});
