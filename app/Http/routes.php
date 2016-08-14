<?php

Route::get('/post/{id}','PostController@show');

Route::get('/','PostController@welcome');

Route::get('/category/{id}','PostController@category');

Route::get('/comment/create','PublicCommentController@create');

Route::auth();

Route::group(['middleware'=>'admin'],function(){

    Route::resource('/admin/users','UserController');

    Route::resource('/admin/posts','PostController');

    Route::resource('/admin/categories','CategoryController');

    Route::resource('/admin/media','MediaController');

    Route::resource('/admin/comments','CommentController');

    Route::resource('/admin/comment/replies','ReplayController');

    Route::get('/admin',function(){
        return view('admin.index');
    });

    Route::get('/admin/comments/change/{id}','CommentController@change');
});