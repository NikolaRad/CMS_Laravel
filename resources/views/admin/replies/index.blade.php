@extends('layouts.admin')

@section('title')
    All replies for comment ID {{$id}}
@endsection

@section('content')
    @if(session('deleted_replay'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible text-center fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('deleted_replay') }}
                    </div>
                </div>
            </div>
    @endif

    @if(count($replies)>0)
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Comment ID</th>
                <th>Is Approved</th>
                <th>Author</th>
                <th>Content</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Change status</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                @foreach($replies as $replay)
                    <tr>
                        <td>{{$replay->id}}</td>
                        <td>{{$replay->comment->id}}</td>
                        <td>{{$replay->is_approved == 0 ? 'Unapproved' : 'Approved'}}</td>
                        <td>{{$replay->author->name}}</td>
                        <td>{{$replay->content}}</td>
                        <td>{{$replay->created_at->diffForHumans()}}</td>
                        <td>{{$replay->updated_at->diffForHumans()}}</td>
                        <td>
                            <a class="btn btn-warning" href="/admin/comment/replies/{{$replay->id}}/edit"><span class="glyphicon glyphicon-refresh"></span></a>
                        </td>
                        <td onclick="return confirm('Are you sure you want to delete this comment?')">
                            {!! Form::model($replay,['method'=>'DELETE','action'=>['ReplayController@destroy',$replay->id]]) !!}
                            {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h2 class="text-center">No replies for this comment.</h2>
    @endif
@endsection