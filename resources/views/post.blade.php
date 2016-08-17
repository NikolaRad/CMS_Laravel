@extends('layouts.blog-post')

@section('content')
        <!-- Blog Post Content Column -->
<div class="col-lg-8">

    <!-- Blog Post -->
    <!-- Title -->
    <h1>{{$post->title}}</h1>
    <!-- Author -->
    <p class="lead">
        by <a href="/admin/users">{{$post->user->name}}</a>
    </p>
    <hr>
    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>
    <!-- Preview Image -->
    <img class="img-responsive img-thumbnail" src="{{ $post->photo ? $post->photo->name : 'http://placehold.it/900x300' }}" alt="">
    <hr>
    <!-- Post Content -->
    <p class="text-justify">{{ $post->content }}</p>
    <hr>

    <!-- Blog Comments -->

    @if(Illuminate\Support\Facades\Auth::user())
        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
            {!! Form::open(['method'=>'GET','action'=>'PublicCommentController@create']) !!}
                <div class="form-group {{$errors->has('content') ? 'has-error' : ''}}">
                    {!! Form::label('content','Content: ') !!}
                    {!! Form::textarea('content',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::hidden('post',$post->id) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Comment',['class'=>'form-control btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @else
        <div class="alert alert-info text-center">
            In order to make a comment you have to be <a href="/login">logged in</a>.
        </div>
    @endif

    <hr>

    <!-- Posted Comments -->

    @if($post->comments)
        @foreach($comments as $comment)
            @if($comment->is_approved == 1)
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object img-responsive img-circle" src="{{$comment->author->photo ? $comment->author->photo->name : 'http://placehold.it/64x64'}}" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$comment->author->name}}
                            <small>{{$comment->created_at->diffForHumans()}}</small>
                            @if(Illuminate\Support\Facades\Auth::user())
                                @if(Illuminate\Support\Facades\Auth::user()->isAdmin())
                                    {!! Form::model($comment,['method'=>'DELETE','action'=>['CommentController@destroy',$comment->id]]) !!}
                                    {!! Form::submit('Delete comment',['class'=>'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                @elseif(Illuminate\Support\Facades\Auth::user()->id == $comment->author->id)
                                    {!! Form::model($comment,['method'=>'DELETE','action'=>['CommentController@destroy',$comment->id]]) !!}
                                    {!! Form::submit('Delete comment',['class'=>'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                @endif
                            @endif
                        </h4>
                        {{$comment->content}}

                        <div class="replay">
                            @if(Illuminate\Support\Facades\Auth::user())
                                <br><button class="replay_button btn btn-primary pull-left">Reply</button>
                            @endif

                            <div class="replay-form">
                                {{--Replay form--}}
                                {!! Form::open(['method'=>'POST','action'=>'PublicRepliesController@store']) !!}
                                <div class="form-group {{$errors->has('replay_content') ? 'has-error' : ''}}">
                                    {!! Form::label('replay_content','Replay content: ') !!}
                                    {!! Form::textarea('replay_content',null,['class'=>'form-control','rows'=>'3']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::hidden('comment',$comment->id) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::submit('Replay',['class'=>'form-control btn btn-primary']) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>

                        @if($comment->replies)
                            @foreach($comment->replies as $replay)
                                @if($replay->is_approved == 1)
                                    <!-- Nested Comment -->
                                    <div class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object img-responsive img-circle" src="{{$replay->author->photo ? $replay->author->photo->name : 'http://www.placehold.it/100x100'}}" alt="">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{$replay->author->name}}
                                                <small>{{$replay->created_at->diffForHumans()}}</small>
                                            </h4>
                                            {{$replay->content}}
                                        </div>
                                    </div>
                                    <!-- End Nested Comment -->
                                @else
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-responsive img-circle" src="{{$replay->author->photo ? $replay->author->photo->name : 'http://www.placehold.it/100x100'}}" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">{{$replay->author->name}}
                                        <small>{{$replay->created_at->diffForHumans()}}</small>
                                    </h4>
                                    <div class="alert alert-info">Comment has not been approved yet.</div>
                                </div>
                            </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            @else
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object img-responsive img-circle" src="{{$comment->author->photo ? $comment->author->photo->name : 'http://placehold.it/64x64'}}" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$comment->author->name}}
                            <small>{{$comment->created_at->diffForHumans()}}</small>
                        </h4>
                        <div class="alert alert-info">Comment has not been approved yet.</div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif

</div>
@endsection

@section('sidebar_categories')
    @if($categories)
    <div class="col-lg-12">
        <ul class="list-unstyled">
            @foreach($categories as $category)
                <li><a href="/category/{{$category->id}}">{{$category->name}}</a></li>
            @endforeach
        </ul>
    </div>
    @endif
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('.replay .replay_button').click(function(){
                $(this).next().slideToggle(500);
            });
        });
    </script>
@endsection