@extends('layouts.admin')

@section('title')
    All Comments
@endsection

@section('content')
    @if(session('deleted_comment'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible text-center fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('deleted_comment') }}
                </div>
            </div>
        </div>
    @endif

    <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Post</th>
            <th>Author</th>
            <th>Is Approved</th>
            <th>Content</th>
            <th>Replies</th>
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
                    <td>{{$comment->author->name}}</td>
                    <td>{{$comment->is_approved == 0 ? 'Unapproved' : 'Approved'}}</td>
                    <td class="text-justify">{{$comment->content}}</td>
                    <td class="text-center"><a href="/admin/comment/replies/{{$comment->id}}">{{count($comment->replies)}}</a></td>
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