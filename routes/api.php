<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//File
Route::get('/files', 'FileController@index');
Route::post('/file', 'FileController@create');
Route::get('/files/{id}', 'FileController@show');


//Passport
Route::post('login', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');

Route::get('/user', function(){
    return request()->user();
});

Route::group(['middleware' => 'auth:api'], function(){

    Route::group(['middleware' => 'check.route.permission'], function () {

        Route::get('/user', function(){
            return request()->user();
        });

        // CRUD DE LOJAS
        Route::group([], function () {

            Route::get('/lojas', ['uses' => 'ShopController@index', 'permission' => 'shop.index']);

            Route::get('/loja/{id}', ['uses' => 'ShopController@find', 'permission' => 'shop.index']);

            Route::post('/loja', ['uses' => 'ShopController@create', 'permission' => 'shop.create']);

            Route::put('/loja/{id}', ['uses' => 'ShopController@update', 'permission' => 'shop.update']);

            Route::delete('/lojas/{id}',['uses' => 'ShopController@destroy', 'permission' => 'shop.index']);
        });
    });
});
