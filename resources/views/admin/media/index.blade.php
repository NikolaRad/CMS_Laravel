@extends('layouts.admin')

@section('title')
    Media
@endsection

@section('content')
    @if(session('deleted_photo'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible text-center fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('deleted_photo') }}
                </div>
            </div>
        </div>
    @endif
    <table class="table table-responsive table-striped table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Used by</th>
            <th>Photo</th>
            <th>Created at</th>
            <th>Trash</th>
          </tr>
        </thead>
        <tbody>
        @if($photos)
            @foreach($photos as $photo)
              <tr>
                <td>{{ $photo->id }}</td>
                <td>
                    @if($photo->user)
                        {{ $photo->user->name }}
                    @elseif($photo->post)
                        {{ $photo->post->title }}
                    @else
                        Photo isn't used
                    @endif
                </td>
                <td><img width="100" class="img-responsive img-rounded" src="{{ $photo->name }}" alt=""></td>
                <td>{{ $photo->created_at ? $photo->created_at->diffForHumans() : "Unknown date" }}</td>
                <td>
                    {!! Form::open(['method'=>'DELETE','action'=>['MediaController@destroy',$photo->id]]) !!}
                        <div class="form-group" onclick="return confirm('Are you sure you want to delete this photo?')">
                            {!! Form::submit('Trash',['class'=>'btn btn-danger']) !!}
                        </div>
                    {!! Form::close() !!}
                </td>
              </tr>
          @endforeach
        @endif
        </tbody>
      </table>
@endsection