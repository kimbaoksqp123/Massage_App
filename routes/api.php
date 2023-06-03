<?php

use App\Http\Controllers\MassageFacilityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/massage-facilities', [MassageFacilityController::class, 'index'])
    ->name('massage-facilities.show');

Route::post('/massage-facilities/filter', [MassageFacilityController::class, 'filter'])
    ->name('massage-facilities.filter');
