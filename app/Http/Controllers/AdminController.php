<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Post;
use App\Reply;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    public function index(){
        $users = User::all();
        $administrators = User::where('role_id',1)->get();
        $authors = User::where('role_id',2)->get();
        $subscribers = User::where('role_id',3)->get();
        $posts = Post::all();
        $drafted = Post::where('status',0)->get();
        $published = Post::where('status',1)->get();
        $comments = Comment::all();
        $approved = Comment::where('is_approved',1)->get();
        $unapproved = Comment::where('is_approved',0)->get();
        $replies = Reply::all();
        $replies_approved = Reply::where('is_approved',1);
        $replies_unapproved = Reply::where('is_approved',0);
        $categories = Category::all();
        return view('admin.index',compact('users','posts','comments','replies','replies_approved','replies_unapproved','administrators','authors','subscribers','approved','unapproved','drafted','published','categories'));
    }
}
