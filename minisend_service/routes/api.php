<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserMailController;
use App\Http\Controllers\UserMailStatisticsController;
use App\Models\UserMail;
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

Route::model('mail', UserMail::class);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('emails')->middleware('auth:api')->group(function () {
    Route::get('', [UserMailController::class, 'index']);
    Route::get('{mail}', [UserMailController::class, 'show']);
    Route::post('send', [UserMailController::class, 'send']);
});

Route::prefix('email-statistics')->middleware('auth:api')->group(function () {
    Route::get('outbox-status', [UserMailStatisticsController::class, 'outboxStatus']);
    Route::get('sent-amount', [UserMailStatisticsController::class, 'sentAmount']);
    Route::get('leading-recipient', [UserMailStatisticsController::class, 'leadingRecipient']);
});

Route::prefix('auth')->middleware('api')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});
