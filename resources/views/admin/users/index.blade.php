@extends('layouts.admin')
@section('content')
    <h1>Users</h1>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>
        @if($users)
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><img height="50" src="{{ $user->photo ? $user->photo->file : 'http://placehold.it/400x400' }}" alt="{{ $user->name }}" class="img-rounded"></td>
                    <td><a href="{{ route('admin.users.edit', $user->id) }}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>{{ $user->status == 1 ? "Active" : "Not Active" }}</td>
                    <td>{{ $user->created_at->diffForhumans() }}</td>
                    <td>{{ $user->updated_at->diffForhumans() }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection