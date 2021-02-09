<?php

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

Route::prefix('mails')->middleware('auth:api')->group(function () {
    Route::get('', 'UserMailController@index');
    Route::get('{mail}', 'UserMailController@show');
    Route::post('send', 'UserMailController@send');
});
