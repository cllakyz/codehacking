@extends('layouts.blog-post')
@section('content')
    <h1>{{$post->title}}</h1>
    <p class="lead">
        by <a href="#">{{ $post->user->name }}</a>
    </p>
    <hr>
    <p><span class="glyphicon glyphicon-time"> Posted {{ $post->created_at->diffForhumans() }}</span></p>
    <hr>
    <img class="img-responsive" src="{{ $post->photo ? $post->photo->file : $post->photoPlaceholder() }}" alt="{{ $post->title }}">
    <hr>
    {{--<p>{{ $post->body }}</p>--}}
    {!! $post->body !!}
    <hr>
    {{--@if(Session::has('comment_message'))
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
                    <img height="64" class="media-object" src="{{ /*$comment->photo*/Auth::user()->gravatar }}" alt="{{ $comment->author }}">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">
                        {{ $comment->author.", ".$comment->email }}
                        <small>{{ $comment->created_at->diffForHumans() }}</small>
                    </h4>
                    <p>{{ $comment->body }}</p>
                    @if(count($comment->replies) > 0)
                        @foreach($comment->replies as $reply)
                            @if($reply->status == 1)
                                <!-- Nested Comment -->
                                <div id="nested-comment" class="media">
                                    <a class="pull-left" href="#">
                                        <img height="64" class="media-object" src="{{ $reply->photo }}" alt="">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{ $reply->author }}
                                            <small>{{ $reply->created_at->diffForHumans() }}</small>
                                        </h4>
                                        <p>{{ $reply->body }}</p>
                                    </div>
                                </div>
                                <!-- End Nested Comment -->
                            @endif
                        @endforeach
                    @endif
                    <div class="comment-reply-container">
                        <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                        <div class="comment-reply col-sm-6">
                            {!! Form::open(['method'=>'POST', 'action'=> 'CommentRepliesController@createReply']) !!}
                            <div class="form-group">
                                <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                {!! Form::label('body', 'Body:') !!}
                                {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>1])!!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('submit', ['class'=>'btn btn-primary']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif--}}
    <div id="disqus_thread"></div>
    <script>

        /**
         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
        /*
        var disqus_config = function () {
        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        */
        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://codehacking-course.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <script id="dsq-count-scr" src="//codehacking-course.disqus.com/count.js" async></script>

@endsection

@section('scripts')
    <script>
        $(document).on('click',".comment-reply-container .toggle-reply",function(){
            $(this).next().slideToggle("slow");
        });
    </script>
@endsection