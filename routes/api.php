<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\FrontEndApiController;
use App\Http\Controllers\AdsApiController;
use App\Http\Controllers\APIs\AuthController;
use App\Http\Controllers\APIs\ApiMessangerController;

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


Route::group(['middleware' => 'api', 'prefix' => 'v1'], function()
{
    Route::get('categories', [FrontEndApiController::class, 'getCategories']);
    Route::get('brands', [FrontEndApiController::class, 'getBrands']);
    Route::get('towns', [FrontEndApiController::class, 'getTowns']);
    Route::get('cities', [FrontEndApiController::class, 'getCities']);

    Route::get('ads/{category}', [AdsApiController::class, 'getAdsByCategory']);
    Route::get('all/ads/{category}', [AdsApiController::class, 'getAdsByCategory']);

    Route::get('ads/details/{ad:slug}', [AdsApiController::class, 'adDetails']);

    Route::get('ads/dropdowndata', [AdsApiController::class, 'getAdsDropDownData']);




});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([

    'middleware' => 'auth:api',
    'prefix' => 'v1'

], function ($router) {

});




Route::group([

    'middleware' => 'api',
    'prefix' => 'v1/auth'

], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('get-profile', [AuthController::class, 'me']);
    Route::post('update-profile', [AuthController::class, 'profileUpdate']);

    // for social media login
    Route::post('social-login', [AuthController::class, 'socialLogin']);
    // for forgot password
    Route::post('customer-forgot-password', [AuthController::class, 'forgot_password']);
    // for password reset
    Route::post('customer-password-update', [AuthController::class, 'resetPassword']);

    // for getting message list
    Route::get('get-messages-list', [ApiMessangerController::class, 'index']);

});

Route::group([

    'middleware' => 'api',
    'prefix' => 'msg'

], function ($router) {
    // for getting message list
    // Route::get('get-messages-list', [ApiMessangerController::class, 'index']);

    // for getting users list for messages
    Route::get('get-messages-user-list', [ApiMessangerController::class, 'getMessagesUserList']);

    // for getting messages for selected user
    Route::post('get-messages-list', [ApiMessangerController::class, 'getMessagesList']);

    // for sending messages for selected user
    Route::post('send-message', [ApiMessangerController::class, 'sendMessage']);

    Route::post('message/{username}', [ApiMessangerController::class, 'sendMessage']);


});
