@extends('layouts.admin')
@section('content')
    @if(Session::has('deleted_photo'))
        <p class="bg-danger">{{ session('deleted_photo') }}</p>
    @endif
    <h1>Medias</h1>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @if($photos)
            @foreach($photos as $photo)
                <tr>
                    <td>{{ $photo->id }}</td>
                    <td><img height="50" src="{{ $photo->file }}" class="img-rounded"></td>
                    <td>{{ $photo->created_at->diffForhumans() }}</td>
                    <td>{{ $photo->updated_at->diffForhumans() }}</td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminPhotosController@destroy', $photo->id]]) !!}
                            {!! Form::submit('Delete Photo', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection