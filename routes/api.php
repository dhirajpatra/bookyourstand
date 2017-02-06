<?php

use Illuminate\Http\Request;

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

Route::group(array('prefix' => 'v1'), function() {
    Route::post('bookmystand', 'EventapiController@index');
    Route::post('bookmystand/geteventdetails', 'EventapiController@getEventDetails');
    Route::post('bookmystand/getallstands', 'EventapiController@getAllStandsOfEvent');
    //Route::post('bookmystand/reservestand', 'EventapiController@reserveStand');
    Route::post('bookmystand/reservestand', 'CompanyapiController@registration');
    Route::post('bookmystand/sendreporttoadmin', 'EventapiController@sendReportToAdmin');

});
