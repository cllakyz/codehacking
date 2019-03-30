@extends('layouts.admin')
@section('content')
    <h1>Edit Post</h1>
    <div class="row">
        <div class="col-sm-3">
            <img src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/400x400' }}" alt="{{ $post->title }}" class="img-responsive img-rounded">
        </div>
        <div class="col-sm-9">
            {!! Form::model($post, ['method' => 'PATCH', 'action' => ['AdminPostsController@update', $post->id], 'files' => true, 'autocomplete' => 'off']) !!}
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
                {!! Form::submit('Update Post', ['class' => 'btn btn-primary col-sm-6']) !!}
            </div>
            {!! Form::close() !!}

            {!! Form::open(['method' => 'DELETE', 'action' => ['AdminPostsController@destroy', $post->id]]) !!}
            <div class="form-group">
                {!! Form::submit('Delete Post', ['class' => 'btn btn-danger col-sm-6']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
        @include('errors.form_error')
    </div>
@endsection