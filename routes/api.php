<?php


use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/



Route::post('login', [AuthController::class, 'login']);
Route::post('forget-password-send-email', [ForgotPasswordController::class, 'forgetPasswordSendEmail']);
Route::post('forget-password', [ForgotPasswordController::class, 'forgetPassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::resource('locations', LocationController::class);
    Route::get('current-location', [LocationController::class, 'currentLocation']);
//========================== admin ==================================//
    Route::prefix('admin')->middleware('isAdmin')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\admin\DashboardController::class, 'index']);
        Route::get('users', [UserController::class, 'index']);
        Route::post('users/store', [UserController::class, 'store']);
        Route::post('users/update/{id}', [UserController::class, 'update']);
        Route::get('users/{id}', [UserController::class, 'show']);
        Route::get('users/{id}/locations', [LocationController::class, 'userLocations']);
        Route::get('users/{id}/current-location', [LocationController::class, 'userCurrentLocation']);
        Route::get('users/delete/{id}', [UserController::class, 'destroy']);
    });
    //  });
    Route::post('/logout', [AuthController::class, 'logout']);
});
