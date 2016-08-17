@extends('layouts.admin')

@section('content')

    @if(session('deleted'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible text-center fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('deleted') }}
                </div>
            </div>
        </div>
    @endif

    @section('title')
        Users
    @endsection

    <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Is Active</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Photo</th>
            <th>Edit</th>
            <th>Trash</th>
          </tr>
        </thead>
        <tbody>
        @if(count($users)>0)
            @foreach($users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                <td>{{ $user->is_active == 1 ? "Yes" : "No" }}</td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
                <td>{{ $user->updated_at->diffForHumans() }}</td>
                @if($user->photo)
                    <td><img height="50" src="{{ $user->photo ? $user->photo->name : "http://www.placehold.it/200x200" }}" alt="User photo"></td>
                @elseif(!$user->photo)
                      <td><img height="50" src="http://www.placehold.it/400x400" alt="User photo"></td>
                @endif
                <td><a class="btn btn-warning" title="Edit user" href="{{ url('/admin/users/' . $user->id . '/edit') }}"><span class="glyphicon glyphicon-edit"></span></a></td>
                <td onclick="return confirm('Are you sure you want to delete this user?')">
                    {!! Form::model($user,['method'=>'DELETE','action'=>['UserController@destroy',$user->id]]) !!}
                    {!! Form::submit('Trash',['class'=>'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
              </tr>
          @endforeach
        @endif
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-6 col-md-offset-5">
            {{$users->render()}}
        </div>
    </div>
@endsection