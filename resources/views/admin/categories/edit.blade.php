@extends('layouts.admin')
@section('content')
    <h1>Edit Category</h1>
    {!! Form::model($category, ['method' => 'PATCH', 'action' => ['AdminCategoriesController@update', $category->id], 'autocomplete' => 'off']) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' =>'form-control'])!!}
    </div>
    <div class="form-group">
        {!! Form::submit('Update Category', ['class' => 'btn btn-primary col-sm-6']) !!}
    </div>
    {!! Form::close() !!}
    {!! Form::open(['method' => 'DELETE', 'action' => ['AdminCategoriesController@destroy', $category->id]]) !!}
    <div class="form-group">
        {!! Form::submit('Delete Category', ['class' => 'btn btn-danger col-sm-6']) !!}
    </div>
    {!! Form::close() !!}
    @include('errors.form_error')
@endsection