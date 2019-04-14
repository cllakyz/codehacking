@extends('layouts.admin')
@section('content')
    @if(Session::has('deleted_photo'))
        <p class="bg-danger">{{ session('deleted_photo') }}</p>
    @endif
    <h1>Medias</h1>
    @if($photos)
        <form action="/delete/media" method="post" class="form-inline">
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <div class="form-group">
                <select name="checkBoxArray" class="form-control">
                    <option value="delete">Delete</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-danger">Submit</button>
            </div>
            <table class="table">
            <thead>
            <tr>
                <th>
                    <input type="checkbox" id="options">
                </th>
                <th>ID</th>
                <th>Name</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
            </thead>
            <tbody>
            @foreach($photos as $photo)
                <tr>
                    <td>
                        <input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="{{ $photo->id }}">
                    </td>
                    <td>{{ $photo->id }}</td>
                    <td><img height="50" src="{{ $photo->file }}" class="img-rounded"></td>
                    <td>{{ $photo->created_at->diffForhumans() }}</td>
                    <td>{{ $photo->updated_at->diffForhumans() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </form>
    @endif
    @section('script')
        <script>
            $(document).ready(function () {
                $(document).on('click', '#options', function () {
                    if($(this).is(':checked')){
                        $('.checkBoxes').prop('checked', true);
                    } else{
                        $('.checkBoxes').prop('checked', false);
                    }
                });
            });
        </script>
    @endsection
@endsection