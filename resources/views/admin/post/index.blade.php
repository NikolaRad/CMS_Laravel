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
            <th>Comments</th>
            <th>Views</th>
            <th>Status</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Trash</th>
          </tr>
        </thead>
        <tbody>
        @if($posts)
            @foreach($posts as $post)
          <tr>
              <td>{{ $post->id }}</td>
              <td>{{ $post->user ? $post->user->name : 'Unknown user' }}</td>
              <td>{{ !$post->category ? 'Default category' : $post->category->name }}</td>
              <td><a href="/post/{{ $post->id }}">{{ $post->title }}</a></td>
              <td>{{ str_limit($post->content,100) }}...</td>
              <td><img width="200" class="img-responsive img-rounded" src="{{ $post->photo ? $post->photo->name : "http://www.placehold.it/200x200" }}" alt=""></td>
              <td class="text-center"><a href="/admin/post/comments/{{$post->id}}">{{count($post->comments)}}</a></td>
              <td class="text-center">{{$post->views ? $post->views : 'No views'}}</td>
              <td>{{$post->status == 0 ? 'drafted' : 'published'}}</td>
              <td>{{ $post->created_at->diffForHumans() }}</td>
              <td>{{ $post->updated_at->diffForHumans() }}</td>
              <td><a class="btn btn-warning" href="/admin/posts/change/{{$post->id}}"><span class="glyphicon glyphicon-refresh"></span></a></td>
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
    <div class="row">
        <div class="col-md-6 col-md-offset-5">
            {{$posts->render()}}
        </div>
    </div>
@endsection