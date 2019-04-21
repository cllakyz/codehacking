@extends('layouts.blog-home')

@section('content')
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            @if($posts)
                @foreach($posts as $post)
                    <h2>
                        <a href="{{ route('home.post', $post->slug) }}">{{ $post->title }}</a>
                    </h2>
                    <p class="lead">
                        by {{ $post->user->name }}
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> {{ $post->created_at->diffForHumans() }}</p>
                    <hr>
                    <img class="img-responsive" src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/900x300' }}" alt="">
                    <hr>
                    <p>{!! str_limit($post->body, 100) !!}</p>
                    <a class="btn btn-primary" href="{{ route('home.post', $post->slug) }}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <hr>
                @endforeach
                <!-- Pagination -->
                <div class="row">
                    <div class="col-md-6 col-md-offset-5">
                        {{ $posts->render() }}
                    </div>
                </div>
            @endif
        </div>
        <!-- Blog Sidebar -->
        @include('includes.front_sidebar')
    </div>
    <!-- /.row -->
@endsection
