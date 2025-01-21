@extends('layouts.app')

@section('form')
<form method="post">
    @csrf
    <div class="form-group">
        <textarea name="body" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

@section('content')
<h1>Create multiple users by JSON input</h1>
@endsection