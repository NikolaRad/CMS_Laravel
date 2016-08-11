@extends('layouts.admin')

@section('title')
    Edit post
@endsection
@section('content')
    @if(session('updated_post'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible text-center fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('updated_post') }}<a href="{{ url('/admin/posts') }}" class="alert-link">View all posts</a>
                </div>
            </div>
        </div>
    @endif
    <div class="col-md-3">
        <img class="img-responsive img-thumbnail" src="{{ $post->photo ? $post->photo->name : "http://www.placehold.it/200x200" }}" alt="Post has no photo">
    </div>
    <div class="col-md-9">
        {!! Form::model($post,["method"=>"PATCH","action"=>["PostController@update",$post->id],"files"=>true]) !!}
        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            {!! Form::label("title","Post title: ") !!}
            {!! Form::text("title",$post->title,["class"=>"form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::label("category","Post category: ") !!}
            {!! Form::select("category",array("0"=>"Default category")+ $categories,$post->category_id,["class"=>"form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::label("photo","Post photo: ") !!}
            {!! Form::file("photo") !!}
        </div>
        <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
            {!! Form::label("content","Post content: ") !!}
            {!! Form::textarea("content",$post->content,["class"=>"form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::submit("Update post",["class"=>"form-control btn btn-primary"]) !!}
        </div>
        {!! Form::close() !!}
    </div>
    @if(count($errors)>0)
        <div class="row">
            <div class="col-md-12">
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible text-center fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ $error }}
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection