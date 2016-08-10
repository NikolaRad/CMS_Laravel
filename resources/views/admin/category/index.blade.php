@extends('layouts.admin')

@section('title')
    Categories
@endsection

@section('content')
    @if(session('created_category'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible text-center fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('created_category') }}
                </div>
            </div>
        </div>
    @endif
    @if(session('updated_category'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible text-center fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('updated_category') }}
                </div>
            </div>
        </div>
    @endif
    @if(session('deleted_category'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible text-center fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('deleted_category') }}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            {!! Form::open(['method'=>'POST','action'=>'CategoryController@store']) !!}
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    {!! Form::label('name','Category name: ') !!}
                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Add category',['class'=>'form-control btn btn-primary']) !!}
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
        </div>
        <div class="col-md-6">
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Trash</th>
                  </tr>
                </thead>
                <tbody>
                @if($categories)
                    @foreach($categories as $category)
                          <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td><a class="btn btn-warning" href="/admin/categories/{{ $category->id }}/edit"><span class="glyphicon glyphicon-edit"></span></a></td>
                            <td onclick="return confirm('Are you sure you want to delete this category.')">
                                {!! Form::model($category,['method'=>'DELETE','action'=>['CategoryController@destroy',$category->id]]) !!}
                                    {!! Form::submit('Trash',['class'=>'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                          </tr>
                  @endforeach
                @endif
                </tbody>
              </table>
        </div>
    </div>
@endsection