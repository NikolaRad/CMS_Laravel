<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(10);
        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::lists('name','id')->all();
        return view('admin.user.add',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['name'=>'required','email'=>'required','password'=>'required']);
        $photo_id = null;
        if($request->file('photo')){
            $photo = Photo::create(['name'=>$request->file('photo')->getClientOriginalName()]);
            $request->file('photo')->move(base_path('\public\images'),$request->file('photo')->getClientOriginalName());
            $photo_id = $photo->id;
        }
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->is_active  =$request->get('is_active');
        $user->role_id = $request->get('role');
        $user->photo_id = $photo_id;
        if($user->save()){
            $request->session()->flash('created','New user has been successfully created. ');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::lists('name','id')->all();
        $user = User::findOrFail($id);
        return view('admin.user.edit',compact('roles','user'));
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
        $this->validate($request,['name'=>'required','email'=>'required']);
        $user = User::findOrFail($id);
        $photo_id = $user->photo_id;
        if($request->file('photo')){
            $photo = Photo::create(['name'=>$request->file('photo')->getClientOriginalName()]);
            $request->file('photo')->move(base_path('\public\images'),$request->file('photo')->getClientOriginalName());
            $photo_id = $photo->id;
        }
        if(!empty($request->get('password'))){
            $password = bcrypt($request->get('password'));
        }else{
            $password = $user->password;
        }
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = $password;
        $user->photo_id = $photo_id;
        $user->is_active = $request->get('is_active');
        $user->role_id = $request->get('role');
        if($user->save()){
            $request->session()->flash('updated','User has been successfully updated.');
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
        $user = User::findOrFail($id);
        $comments = Comment::where('user_id',$id)->get();
        if($user->photo) {
            unlink(public_path() . $user->photo->name);
            $user->photo->delete();
        }
        foreach($user->posts as $post){
            $post->photo->delete();
            $post->delete();
        }
        foreach($comments as $comment){
            $comment->delete();
        }
        if($user->delete()){
            Session::flash('deleted','The user ' . $user->name . ' has been successfully deleted.');
            return redirect(url('/admin/users'));
        }
    }
}
