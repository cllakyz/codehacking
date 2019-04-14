@extends('layouts.admin')
@section('content')
    @include('includes.tinyeditor')
    <h1>Create Post</h1>
    {!! Form::open(['method' => 'POST', 'action' => 'AdminPostsController@store', 'files' => true, 'autocomplete' => 'off']) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class' =>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('category_id', 'Category:') !!}
            {!! Form::select('category_id', ['' => 'Choose Category'] + $categories , null, ['class' => 'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('photo_id', 'Photo:') !!}
            {!! Form::file('photo_id', ['class' => 'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('body', 'Body:') !!}
            {!! Form::textarea('body', null, ['class' =>'form-control', 'rows' => 3])!!}
        </div>
        <div class="form-group">
            {!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
    @include('errors.form_error')
@endsection