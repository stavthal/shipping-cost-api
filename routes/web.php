<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\TokenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/basic', [ApiController::class, 'index']);

Route::post('/token', [TokenController::class, 'generate']);

Route::post('/shipping-areas', [ApiController::class, 'getShippingAreas']);

Route::post('/shipping-methods', [ApiController::class, 'getShippingMethods']);

Route::post('/shipping-cost', [ApiController::class, 'getShippingCost']);

