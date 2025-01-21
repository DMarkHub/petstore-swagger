@extends('layouts.app')

@section('form')
<form method="post">
    @csrf
    <div class="form-group">
        <input type="hidden" name="id" class="form-control" value="{{isset($form['id']) ? $form['id'] : 0;}}">
    </div>
    <div class="form-group">
        <input type="text" name="username" class="form-control" placeholder="Username" value="{{isset($form['username']) ? $form['username'] : '';}}">
    </div>
    <div class="form-group">
        <input type="text" name="firstName" class="form-control" placeholder="First Name"
            value="{{isset($form['firstName']) ? $form['firstName'] : '';}}">
    </div>
    <div class="form-group">
        <input type="text" name="lastName" class="form-control" placeholder="Last Name" value="{{isset($form['lastName']) ? $form['lastName'] : '';}}">
    </div>
    <div class="form-group">
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{isset($form['email']) ? $form['email'] : '';}}">
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password" value="">
    </div>
    <div class="form-group">
        <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{isset($form['phone']) ? $form['phone'] : '';}}">
    </div>
    <div class="form-group">
        <input type="number" name="userStatus" class="form-control" placeholder="User Status"
            value="{{isset($form['userStatus']) ? $form['userStatus'] : '';}}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

@section('content')
@if (isset($form['username']))
<h1>Update user {{$form['username']}}</h1>
@else
<h1>Create user</h1>
@endif
@endsection