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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('students', 'ApiController@getAllStudents');
Route::post('students', 'ApiController@createStudent');

Route::get('students/{id}', 'ApiController@getStudent');
Route::put('students/{id}','ApiController@updateStudent');
Route::delete('students/{id}','ApiController@deleteStudent');

//all routes prefixed with /api by default. eg /api/students/{id} ?
