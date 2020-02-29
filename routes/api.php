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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'ApiController@login');
Route::get('teste', 'TesteController@teste')->middleware('auth.jwt');

//Route::domain('http://localhost:8000/graphql')->group(function () {
//    Route::post(
//        'graphql',
//        [\Rebing\GraphQL\GraphQLController::class, 'mutation']
//    )->middleware();
//});


//Route::post('graphql/login', 'AuthenticateController@authenticate');
