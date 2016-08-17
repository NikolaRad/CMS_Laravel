<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class PublicCommentController extends Controller
{
    public function create(Request $request){
        $this->validate($request,['content'=>'required']);
        $post_id = $request->get('post');
        $author_id = Auth::user()->id;
        $content = $request->get('content');
        $comment = new Comment();
        $comment->post_id = $post_id;
        $comment->author_id = $author_id;
        $comment->content = $content;
        $comment->save();
        return redirect()->back();
    }
}
