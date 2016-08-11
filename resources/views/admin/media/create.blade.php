@extends('layouts.admin')

@section('title')
    Upload media
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
@endsection

@section('content')

    {!! Form::open(['method'=>'POST','action'=>'MediaController@store','class'=>'dropzone']) !!}

    {!! Form::close() !!}

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
@endsection