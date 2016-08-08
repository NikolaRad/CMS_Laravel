<?php

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::group(['middleware'=>'admin'],function(){

    Route::resource('/admin/users','UserController');

    Route::get('/admin',function(){
        return view('admin.index');
    });
});