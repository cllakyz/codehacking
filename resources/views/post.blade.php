@extends('layouts.blog-post')
@section('content')
    <h1>{{$post->title}}</h1>
    <p class="lead">
        by <a href="#">{{ $post->user->name }}</a>
    </p>
    <hr>
    <p><span class="glyphicon glyphicon-time"> Posted {{ $post->created_at->diffForhumans() }}</span></p>
    <hr>
    <img class="img-responsive" src="{{ $post->photo->file }}" alt="{{ $post->title }}">
    <hr>
    <p>{{ $post->body }}</p>
    <hr>
    @if(Session::has('comment_message'))
        {{ session('comment_message') }}
        <hr>
    @endif
    @if(Auth::check())
        <div class="well">
            <h4>Leave a Comment:</h4>
            {!! Form::open(['method'=>'POST', 'action'=> 'PostCommentsController@store']) !!}
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="form-group">
                {!! Form::label('body', 'Body:') !!}
                {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>3])!!}
            </div>
            <div class="form-group">
                {!! Form::submit('Submit Comment', ['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <hr>
    @endif
    @if(count($comments) > 0)
        @foreach($comments as $comment)
            <div class="media">
                <a href="#" class="pull-left">
                    <img height="64" class="media-object" src="{{ $comment->photo }}" alt="{{ $comment->author }}">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">
                        {{ $comment->author.", ".$comment->email }}
                        <small>{{ $comment->created_at->diffForHumans() }}</small>
                    </h4>
                    {{ $comment->body }}
                </div>
            </div>
        @endforeach
    @endif
@endsection
