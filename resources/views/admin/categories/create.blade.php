@extends('layouts.admin')
@section('content')
    <h1>Create Category</h1>
    {!! Form::open(['method' => 'POST', 'action' => 'AdminCategoriesController@store', 'autocomplete' => 'off']) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' =>'form-control'])!!}
    </div>
    <div class="form-group">
        {!! Form::submit('Create Category', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
    @include('errors.form_error')
@endsection