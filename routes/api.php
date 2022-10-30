<?php

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
Route::post('checkUserMobileExist','Api\GeneralController@checkUserMobileExist');
Route::post('checkUserMobileExist','Api\GeneralController@checkUserMobileExist');
Route::post('checkVerificationCode','Api\GeneralController@checkVerificationCode');
Route::post('userSignUp','Api\GeneralController@userSignUp');
Route::post('userLogin ','Api\GeneralController@login');

Route::post('addUserMessage','Api\GeneralController@addUserMessage');
Route::post('getUserInfo','Api\GeneralController@getUserInfo');
Route::post('addImage','Api\GeneralController@addImage');


Route::post('updateDriverLocation','Api\GeneralController@updateDriverLocation');
Route::post('getTrackDriverInfo','Api\GeneralController@getTrackDriverInfo');


Route::group(['middleware' => 'auth:api'], function () {
    Route::post('getMyComplaints','Api\GeneralController@getMyComplaints');
    Route::post('getUserUsersRates','Api\GeneralController@getUserUsersRates');
    Route::post('changeNotificationsStatus','Api\GeneralController@changeNotificationsStatus');
    Route::post('getPages','Api\GeneralController@getPages');
    Route::post('getOnePageDetails','Api\GeneralController@getOnePageDetails');
    Route::post('userChangeProfile','Api\GeneralController@userChangeProfile');
    Route::post('getCarTypes','Api\GeneralController@getCarTypes');
    Route::post('addRepresentativeRequest','Api\GeneralController@addRepresentativeRequest');
    Route::post('setDeviceToken','Api\TokensController@setDeviceToken');
    Route::post('updateDevicesLanguage','Api\TokensController@updateDevicesLanguage');
    Route::post('userLogout','Api\TokensController@userLogout');
    Route::post('getMyUserNotifications','Api\TokensController@getMyUserNotifications');
    Route::post('getMyCars','Api\GeneralController@getMyCars');
    Route::post('getConversationMessage','Api\GeneralController@getConversationMessage');

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
