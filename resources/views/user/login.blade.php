@extends('layouts.app')

@section('form')
<form method="post">
    @csrf
    <div class="form-group">
        <input type="text" name="username" class="form-control" placeholder="Username">
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

@section('content')
<h1>Login user</h1>
@endsection