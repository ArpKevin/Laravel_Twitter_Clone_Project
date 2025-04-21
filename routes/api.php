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

Route::get('/pins', [PinController::class, 'index']);

// Route::post('/add-pin', [AuthController::class, 'addPin'])->middleware('auth:sanctum');

// Route::get('/user-pin-ids', [AuthController::class, 'getUserPinIds'])->middleware('auth:sanctum');