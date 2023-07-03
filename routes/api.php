<?php

use App\Http\Controllers\MassageFacilityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RatingController;
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

Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::post('/register', [AuthController::class, 'register'])->name('user.register');

Route::prefix('massage-facilities')->group(function () {

    Route::get('/', [MassageFacilityController::class, 'index'])
        ->name('massage-facilities.show');

    Route::post('/filter', [MassageFacilityController::class, 'filter'])
        ->name('massage-facilities.filter');

    Route::get('/detail/{id}', [MassageFacilityController::class, 'detail'])
        ->name('massage-facilities.detail');
});

Route::middleware('auth:sanctum')->prefix('user')->group(function () {

    Route::get('/', [AuthController::class, 'user']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->prefix('massage-facilities')->group(function () {

    Route::post('/store', [MassageFacilityController::class, 'store'])
        ->name('massage-facilities.store');
});

Route::middleware('auth:sanctum')->prefix('ratings')->group(function () {

    Route::post('/store', [RatingController::class, 'store'])
        ->name('ratings.store');
});

Route::prefix('ratings')->group(function () {

    Route::get('/index/{facilityID}/{page?}', [RatingController::class, 'index'])
        ->name('ratings.index');
});

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    // phê duyệt yêu cầu mở quán massage
    Route::get('/requestNotActive', [AdminController::class, 'requestNotActive'])->name('admin.requestNotActive');
    Route::get('/requestActive', [AdminController::class, 'requestActive'])->name('admin.requestActive');
    Route::post('/request/accept', [AdminController::class, 'requestAccept'])->name('admin.requestAccept');
    Route::post('/request/deny', [AdminController::class, 'requestDeny'])->name('admin.requestDeny');

    // tìm kiếm quán massage
    Route::post('/filter', [AdminController::class, 'filter'])
        ->name('admin.filter');

    Route::post('/deactiveFacility', [AdminController::class, 'deactiveFacility'])->name('admin.deactiveFacility');

    Route::post('/activeFacility', [AdminController::class, 'activeFacility'])->name('admin.activeFacility');

    Route::post('/removeFacility', [AdminController::class, 'removeFacility'])->name('admin.removeFacility');

});
