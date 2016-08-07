@extends('layouts.admin')

@section('content')
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
                    <td><img height="50" src="{{ $user->photo->name }}" alt="User photo"></td>
                @elseif(!$user->photo)
                      <td><img height="50" src="http://www.placehold.it/400x400" alt="User photo"></td>
                @endif
                <td><a href="{{ url('/admin/users/' . $user->id . '/edit') }}"><span style="font-size: large;" class="glyphicon glyphicon-edit"></span></a></td>
              </tr>
          @endforeach
        @endif
        </tbody>
      </table>

@endsection