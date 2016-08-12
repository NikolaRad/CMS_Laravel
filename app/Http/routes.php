<?php

Route::get('/post/{id}','PostController@post');

Route::get('/','PostController@welcome');

Route::get('/category/{id}','PostController@category');

Route::auth();

Route::group(['middleware'=>'admin'],function(){

    Route::resource('/admin/users','UserController');

    Route::resource('/admin/posts','PostController');

    Route::resource('/admin/categories','CategoryController');

    Route::resource('/admin/media','MediaController');

    Route::resource('/admin/comments','CommentController');

    Route::resource('/admin/comment/replies','ReplyController');

    Route::get('/admin',function(){
        return view('admin.index');
    });
});