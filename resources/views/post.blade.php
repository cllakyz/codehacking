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
@endsection
