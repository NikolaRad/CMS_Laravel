<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReplayController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $replies = Reply::where('comment_id',$id)->get();
        return view('admin.replies.index',compact('replies','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $replay = Reply::findOrFail($id);
        $replay->is_approved == 0 ? $replay->is_approved = 1 : $replay->is_approved = 0;
        $replay->save();
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
        $replay = Reply::findOrFail($id);
        $replay->delete();
        Session::flash('deleted_replay', 'Replay has been successfully deleted.');
        return redirect()->back();
    }
}
