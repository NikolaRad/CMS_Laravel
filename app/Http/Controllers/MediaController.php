<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class MediaController extends Controller
{
    public function index(){
        $photos = Photo::orderBy('id','desc')->paginate(10);
        return view('admin.media.index',compact('photos'));
    }

    public function create(){
        return view('admin.media.create');
    }

    public function store(Request $request){
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $file->move(base_path('public/images'),$name);
        Photo::create(['name'=>$name]);
    }

    public function destroy($id){
        $photo = Photo::findOrFail($id);
        $id = $photo->id;
        $name = $photo->name;
        unlink(public_path() . $name);
        if($photo->delete()){
            Session::flash('deleted_photo','Photo with ID ' . $id . ' has been successfully deleted.');
        }
        return redirect()->back();
    }
}
