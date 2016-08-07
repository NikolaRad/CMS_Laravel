@extends('layouts.admin')

@section('title')
    Edit User
@endsection

@section('content')
    @if(session('updated'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible text-center fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('updated') }}<a href="{{ url('/admin/users') }}" class="alert-link">View all users</a>
                </div>
            </div>
        </div>
    @endif
    <div class="col-sm-3">
        @if($user->photo)
            <img class="img-responsive img-rounded" src="{{ $user->photo->name }}" alt="User photo">
        @elseif(!$user->photo)
            <img class="img-responsive img-rounded" src="http://www.placehold.it/400x400" alt="">
        @endif
    </div>
    
    <div class="col-sm-9">
    {!! Form::model($user, ["method"=>"PATCH","action"=>["UserController@update",$user->id],"files"=>true]) !!}
    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        {!! Form::label('Name: ') !!}
        {!! Form::text('name',$user->name,["class"=>"form-control"]) !!}
    </div>
    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        {!! Form::label('Email: ') !!}
        {!! Form::email('email',$user->email,["class"=>"form-control"]) !!}
    </div>
    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
        {!! Form::label('Password: ') !!}
        {!! Form::password('password',["class"=>"form-control"]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('Photo: ') !!}
        {!! Form::file('photo') !!}
    </div>
    <div class="form-group">
        {!! Form::label('Status: ') !!}
        {!! Form::select('is_active',array(0=>'Inactive',1=>'Active'),$user->is_active,["class"=>"form-control"]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('Role: ') !!}
        {!! Form::select('role',array()+ $roles,$user->role_id,["class"=>"form-control"]) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Update User',["class"=>"form-control btn btn-primary"]) !!}
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