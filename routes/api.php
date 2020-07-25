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
Route::get('users', 'UsersController@index');
Route::get('users/{id}', 'UsersController@show');
Route::post('users', 'UsersController@store');
Route::put('users/{id}', 'UsersController@update');
Route::delete('users/{id}', 'UsersController@destroy');

Route::get('firstyear', 'FirstYearController@index');
Route::get('firstyear/{id}', 'FirstYearController@show');
Route::post('firstyear', 'FirstYearController@store');
Route::put('firstyear/{id}', 'FirstYearController@update');
Route::delete('firstyear/{id}', 'FirstYearController@destroy');

Route::get('secondyear', 'SecondYearController@index');
Route::get('secondyear/{id}', 'SecondYearController@show');
Route::post('secondyear', 'SecondYearController@store');
Route::put('secondyear/{id}', 'SecondYearController@update');
Route::delete('secondyear/{id}', 'SecondYearController@destroy');

Route::get('thirdyear', 'ThirdYearController@index');
Route::get('thirdyear/{id}', 'ThirdYearController@show');
Route::post('thirdyear', 'ThirdYearController@store');
Route::put('thirdyear/{id}', 'ThirdYearController@update');
Route::delete('thirdyear/{id}', 'ThirdYearController@destroy');

Route::get('fourthyear', 'FourthYearController@index');
Route::get('fourthyear/{id}', 'FourthYearController@show');
Route::post('fourthyear', 'FourthYearController@store');
Route::put('fourthyear/{id}', 'FourthYearController@update');
Route::delete('fourthyear/{id}', 'FourthYearController@destroy');

Route::get('fifthyear', 'FifthYearController@index');
Route::get('fifthyear/{id}', 'FifthYearController@show');
Route::post('fifthyear', 'FifthYearController@store');
Route::put('fifthyear/{id}', 'FifthYearController@update');
Route::delete('fifthyear/{id}', 'FifthYearController@destroy');

    

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
