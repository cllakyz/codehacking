@extends('layouts.admin')
@section('content')
    @if(Session::has('deleted_category'))
        <p class="bg-danger">{{ session('deleted_category') }}</p>
    @endif
    <h1>Categories</h1>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>
        @if($categories)
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td><a href="{{ route('admin.categories.edit', $category->id) }}">{{ $category->name }}</a></td>
                    <td>{{ $category->created_at->diffForhumans() }}</td>
                    <td>{{ $category->updated_at->diffForhumans() }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection