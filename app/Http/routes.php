<?php

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::resource('/admin/users','UserController');

Route::get('/admin',function(){
    return view('admin.index');
})->middleware('auth');