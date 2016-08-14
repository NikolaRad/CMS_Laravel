<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','desc')->get();
        return view('admin.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists('name','id')->all();
        return view('admin.post.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['title'=>'required','content'=>'required']);
        $photo_id = null;
        if($file = $request->file('photo')){
            $name = $file->getClientOriginalName();
            $photo = Photo::create(['name'=>$name]);
            $file->move(base_path('/public/images'),$name);
            $photo_id = $photo->id;
        }
        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->category_id = $request->get('category');
        $post->photo_id = $photo_id;
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        if($post->save()){
            $request->session()->flash('created_post','The post has been successfully created.');
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
        $categories = Category::all();
        $post = Post::findOrFail($id);
        $comments = Comment::where('post_id',$id)->get();
        $post->views = $post->views + 1;
        $post->save();
        return view('post',compact('post','categories','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::lists('name','id')->all();
        return view('admin.post.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,['title'=>'required','content'=>'required']);
        $post = Post::findOrFail($id);
        $post->user_id = Auth::user()->id;
        if($request->get('category') != 0){
            $post->category_id = $request->get('category');
        }
        if($file = $request->file('photo')){
            $name = $file->getClientOriginalName();
            $photo = Photo::create(['name'=>$name]);
            $file->move(base_path('/public/images'),$name);
            $post->photo_id = $photo->id;
        }
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        if($post->save()){
            $request->session()->flash('updated_post','The post has been successfully updated.');
        }
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
        $post = Post::findOrFail($id);
        $photo = $post->photo->name;
        unlink(public_path() . $photo);
        $post->photo->delete();
        if($post->delete()){
            Session::flash('deleted_post','The post with ID ' . $post->id . ' has been successfully deleted.');
        }
        return redirect()->back();
    }

    public function welcome(){
        $posts = Post::all();
        $categories = Category::all();
        return view('welcome',compact('categories','posts'));
    }

    public function category($id){
        $posts = Post::where('category_id',$id)->get();
        $categories = Category::all();
        return view('welcome',compact('categories','posts'));
    }
}
