<?php

//后台管理
Route::group(['prefix' => 'admin'], function(){

    //登陆展示
    Route::get('/login', '\App\Admin\Controllers\LoginController@index')->name('login');
    //登陆行为
    Route::post('/login', '\App\Admin\Controllers\LoginController@login');
    //登出行为
    Route::get('/logout', '\App\Admin\Controllers\LoginController@logout');

    //需要登陆的路由
    Route::group(['middleware' => 'auth:admin'], function(){
        //首页
        Route::get('/home', '\App\Admin\Controllers\HomeController@index');

        //
        // 用户管理
        Route::get('/users', '\App\Admin\Controllers\UserController@index');
        Route::get('/users/create', '\App\Admin\Controllers\UserController@create');
        Route::post('/users/store', '\App\Admin\Controllers\UserController@store');
    });


});