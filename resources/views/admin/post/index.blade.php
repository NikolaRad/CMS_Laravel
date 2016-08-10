@extends('layouts.admin')

@section('title')
    Posts
@endsection

@section('content')
    @if(session('deleted_post'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible text-center fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('deleted_post') }}
                </div>
            </div>
        </div>
    @endif

    <table class="table table-hover table-responsive table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Category</th>
            <th>Title</th>
            <th>Content</th>
            <th>Photo</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Edit</th>
            <th>Trash</th>
          </tr>
        </thead>
        <tbody>
        @if($posts)
            @foreach($posts as $post)
          <tr>
              <td>{{ $post->id }}</td>
              <td>{{ $post->user->name }}</td>
              <td>{{ !$post->category ? 'Default category' : $post->category->name }}</td>
              <td>{{ $post->title }}</td>
              <td>{{ str_limit($post->content,100) }}...</td>
              <td><img class="img-responsive img-rounded" src="{{ $post->photo->name }}" alt=""></td>
              <td>{{ $post->created_at->diffForHumans() }}</td>
              <td>{{ $post->updated_at->diffForHumans() }}</td>
              <td><a class="btn btn-warning" href="/admin/posts/{{ $post->id }}/edit"><span class="glyphicon glyphicon-edit"></span></a></td>
              <td onclick="return confirm('Are you sure you want to delete this user?')">
              {!! Form::model($post,["method"=>"DELETE","action"=>['PostController@destroy',$post->id]]) !!}
                    {!! Form::submit("Trash",["class"=>"form-control btn btn-danger"]) !!}
              {!! Form::close() !!}
              </td>
          </tr>
            @endforeach
        @endif
        </tbody>
      </table>
@endsection