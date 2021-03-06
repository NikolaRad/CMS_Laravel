<?php

Route::get('/post/{id}','PostController@show');

Route::get('/','PostController@welcome');

Route::get('/category/{id}','PostController@category');

Route::auth();

Route::group(['middleware'=>'auth'], function(){

    Route::get('/comment/create','PublicCommentController@create');

    Route::post('/comment/replies','PublicRepliesController@store');
});

Route::group(['middleware'=>'admin'],function(){

    Route::resource('/admin/users','UserController');

    Route::resource('/admin/posts','PostController');

    Route::resource('/admin/categories','CategoryController');

    Route::resource('/admin/media','MediaController');

    Route::resource('/admin/comments','CommentController');

    Route::resource('/admin/comment/replies','ReplayController');

    Route::get('/admin','AdminController@index');

    Route::get('/admin/comments/change/{id}','CommentController@change');

    Route::get('/admin/posts/change/{id}','PostController@change');

    Route::get('/admin/post/comments/{id}','CommentController@show');
});