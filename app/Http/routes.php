<?php

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::group(['middleware'=>'admin'],function(){

    Route::resource('/admin/users','UserController');

    Route::resource('/admin/posts','PostController');

    Route::resource('/admin/categories','CategoryController');

    Route::get('/admin',function(){
        return view('admin.index');
    });
});