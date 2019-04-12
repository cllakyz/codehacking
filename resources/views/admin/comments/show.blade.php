@extends('layouts.admin')
@section('content')
    <h1>Comments</h1>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Email</th>
            <th>Body</th>
            <th>Post Title</th>
            <th>Change Status</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @if(count($comments) > 0)
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->author }}</td>
                    <td>{{ $comment->email }}</td>
                    <td>{{ $comment->body }}</td>
                    <td><a href="{{ route('home.post', $comment->post->slug) }}">{{ $comment->post->title }}</a></td>
                    <td>
                        {!! Form::open(['method'=>'PATCH', 'action'=> ['PostCommentsController@update', $comment->id]]) !!}
                        @if($comment->status == 1)
                            <input type="hidden" name="status" value="0">
                            <div class="form-group">
                                {!! Form::submit('Unapprove', ['class'=>'btn btn-default']) !!}
                            </div>
                            @else
                            <input type="hidden" name="status" value="1">
                            <div class="form-group">
                                {!! Form::submit('Approve', ['class'=>'btn btn-success']) !!}
                            </div>
                        @endif
                        {!! Form::close() !!}
                    </td>
                    <td>
                        {!! Form::open(['method'=>'DELETE', 'action'=> ['PostCommentsController@destroy', $comment->id]]) !!}
                        <div class="form-group">
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            @else
            <tr><td colspan="7" class="text-center">No Comments</td></tr>
        @endif
        </tbody>
    </table>
@endsection