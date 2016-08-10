@extends('layouts.admin')

@section('title')
    Edit category
@endsection

@section('content')
    {!! Form::model($category,['method'=>'PATCH','action'=>['CategoryController@update',$category->id]]) !!}
    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        {!! Form::label('name','Category name: ') !!}
        {!! Form::text('name',$category->name,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Update category',['class'=>'form-control btn btn-primary']) !!}
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