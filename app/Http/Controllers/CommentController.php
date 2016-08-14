<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::orderBy('id','desc')->get();
        return view('admin.comment.index',compact('comments'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['content'=>'required']);
        $post_id = $request->get('post');
        $author_id = Auth::user()->id;
        $content = $request->get('content');
        $comment = new Comment();
        $comment->post_id = $post_id;
        $comment->user_id = $author_id;
        $comment->content = $content;
        $comment->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->back();
    }

    public function change($id){
        $comment = Comment::findOrFail($id);
        if($comment->is_approved == 0){
            $comment->is_approved = 1;
        }elseif($comment->is_approved == 1){
            $comment->is_approved = 0;
        }
        $comment->save();
        return redirect()->back();
    }
}
