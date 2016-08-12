@extends('layouts.blog-home')

@section('content')
    @if($posts)
        @foreach($posts as $post)
            <!-- Blog Post -->
            <h2>
                <a href="/post/{{$post->id}}">{{$post->title}}</a>
            </h2>
            <p class="lead">
                by <a href="/admin/users">{{$post->user->name}}</a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>
            <hr>
            <img class="img-responsive img-rounded" src="{{$post->photo ? $post->photo->name : 'http://placehold.it/900x300'}}" alt="">
            <hr>
            <p class="text-justify">{{str_limit($post->content,200)}}</p>
            <a class="btn btn-primary" href="/post/{{$post->id}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        @endforeach
    @else
        <h2>There is no posts</h2>
    @endif
@endsection

@section('categories')
    @if($categories)
        <ul class="list-unstyled">
            @foreach($categories as $category)
                <li><a href="/category/{{$category->id}}">{{$category->name}}</a></li>
            @endforeach
        </ul>
    @endif
@endsection
