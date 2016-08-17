<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class PublicRepliesController extends Controller
{
    public function store(Request $request){
        if($request->get('replay_content') != ''){
            $comment_id = $request->get('comment');
            $author_id = Auth::user()->id;
            $content = $request->get('replay_content');
            $replay = new Reply();
            $replay->comment_id = $comment_id;
            $replay->author_id = $author_id;
            $replay->content = $content;
            $replay->save();
            return redirect()->back();
        }
        return redirect()->back();
    }
}
