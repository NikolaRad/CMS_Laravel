@extends('layouts.admin')
@section('title')
    Add new user
@endsection
@section('content')
    @if(session('created'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible text-center fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('created') }}<a href="{{ url('/admin/users') }}" class="alert-link">View all users</a>
                </div>
            </div>
        </div>
    @endif
    {!! Form::open(["method"=>"POST","action"=>"UserController@store"]) !!}
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('Name: ') !!}
            {!! Form::text('name',Request::old('name'),["class"=>"form-control"]) !!}
        </div>
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            {!! Form::label('Email: ') !!}
            {!! Form::email('email',Request::old('email'),["class"=>"form-control"]) !!}
        </div>
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            {!! Form::label('Password: ') !!}
            {!! Form::text('password',Request::old('password'),["class"=>"form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Add User',["class"=>"form-control btn btn-primary"]) !!}
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