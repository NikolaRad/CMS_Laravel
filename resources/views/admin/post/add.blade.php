@extends('layouts.admin')

@section('title')
    Create new post
@endsection

@section('content')
    @if(session('created_post'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible text-center fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('created_post') }}<a href="{{ url('/admin/posts') }}" class="alert-link">View all posts</a>
                </div>
            </div>
        </div>
    @endif
    {!! Form::open(["method"=>"POST","action"=>"PostController@store","files"=>true]) !!}
        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            {!! Form::label("title","Post title: ") !!}
            {!! Form::text("title",Request::old('title'),["class"=>"form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::label("category","Post category: ") !!}
            {!! Form::select("category",array("0"=>"Default category")+ $categories,0,["class"=>"form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::label("photo","Post photo: ") !!}
            {!! Form::file("photo") !!}
        </div>
        <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
            {!! Form::label("content","Post content: ") !!}
            {!! Form::textarea("content",Request::old('content'),["class"=>"form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::submit("Create post",["class"=>"form-control btn btn-primary"]) !!}
        </div>
    {!! Form::close() !!}
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