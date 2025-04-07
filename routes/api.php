<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\DataExportController;
use App\Http\Controllers\PinController;

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

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Data export routes
    Route::get('/export/user-data', [DataExportController::class, 'exportData']);
    Route::get('/export/public-data', [DataExportController::class, 'getAllPublicData']);
});

Route::get('/pins', [PinController::class, 'index'])->name("pins.index");

Route::post('/add-pin', [AuthController::class, 'addPin'])->middleware('auth:sanctum');

Route::get('/user-pin-ids', [AuthController::class, 'getUserPinIds'])
// ->middleware('auth:sanctum')
;