<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PinController;
use App\Http\Controllers\ApiAuthController;

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

Route::get('/pins', [PinController::class, 'index'])->name("pins.index");

Route::post('/add-pin', [AuthController::class, 'addPin'])->middleware('auth:sanctum');

Route::get('/user-pin-ids', [AuthController::class, 'getUserPinIds'])
// ->middleware('auth:sanctum')
;
Route::post('/register', [ApiAuthController::class, 'register']);
Route::post("login", [ApiAuthController::class, 'login']);