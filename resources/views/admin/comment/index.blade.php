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
            <th>Change status</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
            @if($comments)
                @foreach($comments as $comment)
                  <tr>
                    <td>{{$comment->id}}</td>
                    <td><a href="/post/{{$comment->post->id}}">{{$comment->post->title}}</a></td>
                    <td>{{$comment->user->name}}</td>
                    <td>{{$comment->is_approved == 0 ? 'Unapproved' : 'Approved'}}</td>
                    <td class="text-justify">{{$comment->content}}</td>
                    <td>{{$comment->created_at->diffForHumans()}}</td>
                    <td>{{$comment->updated_at->diffForHumans()}}</td>
                    <td>
                        <a class="btn btn-warning" href="/admin/comments/change/{{$comment->id}}"><span class="glyphicon glyphicon-refresh"></span></a>
                    </td>
                    <td onclick="return confirm('Are you sure you want to delete this comment?')">
                        {!! Form::model($comment,['method'=>'DELETE','action'=>['CommentController@destroy',$comment->id]]) !!}
                            {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                  </tr>
                @endforeach
            @endif
        </tbody>
      </table>
@endsection