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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', 'RegisterController@register');
Route::post('login', 'RegisterController@login');

Route::middleware(['auth:api','json.response'])->group( function () {
    Route::get('notes', 'NoteController@index');
    Route::get('note/{id}', 'NoteController@show');
    Route::put('note/{id}', 'NoteController@update');
    Route::post('note', 'NoteController@create');
    Route::delete('note/{id}', 'NoteController@destroy');
});
