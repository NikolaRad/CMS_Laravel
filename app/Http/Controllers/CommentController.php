<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        foreach($comment->replies as $replay){
            $replay->delete();
        }
        Session::flash('deleted_comment', 'Comment has been successfully deleted.');
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

    public function show($id){
        $comments = Comment::where('post_id',$id)->orderBy('id','desc')->get();
        return view('admin.comment.index',compact('comments'));
    }
}
