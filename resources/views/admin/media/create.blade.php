@extends('layouts.admin')
@section('content')
    <h1>Upload Media</h1>
    {!! Form::open(['method' => 'POST', 'action' => 'AdminPhotosController@store', 'class' => 'dropzone', 'files' => true, 'autocomplete' => 'off']) !!}

    {!! Form::close() !!}
    @include('errors.form_error')
@endsection
@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css" rel="stylesheet">
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
@endsection