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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('/empdata', 'EmployeeController@store');
Route::get('/empdata/{ip_address}', 'EmployeeController@show');
Route::delete('/empdata/{ip_address}', 'EmployeeController@destroy');

Route::post('/empwebhistory', 'EmployeeWebHistoryController@store');
Route::get('/empwebhistory/{ip_address}', 'EmployeeWebHistoryController@show');
Route::delete('/empwebhistory/{ip_address}', 'EmployeeWebHistoryController@destroy');
