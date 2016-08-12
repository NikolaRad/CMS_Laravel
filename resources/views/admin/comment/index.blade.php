@extends('layouts.admin')

@section('title')
    All Comments
@endsection

@section('content')
    <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Post</th>
            <th>Author</th>
            <th>Is Approved</th>
            <th>Content</th>
            <th>Created</th>
            <th>Updated</th>
          </tr>
        </thead>
        <tbody>
            @if($comments)
                @foreach($comments as $comment)
                  <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->post->title}}</td>
                    <td>{{$comment->user->name}}</td>
                    <td>{{$comment->is_approved}}</td>
                    <td>{{$comment->content}}</td>
                    <td>{{$comment->created_at->diffForHumans()}}</td>
                    <td>{{$comment->updated_at->diffForHumans()}}</td>
                  </tr>
                @endforeach
            @endif
        </tbody>
      </table>
@endsection