@extends('layouts.app')

@section('form')
<form method="post">
    @csrf
    <div class="form-group">
        <input type="hidden" name="id" class="form-control" value="{{$form['id'] ?? ''}}">
    </div>
    <div class="form-group">
        <input type="text" name="category" class="form-control" placeholder="Category name"
            value="{{$form['category'] ?? ''}}">
    </div>
    <div class="form-group">
        <input type="text" name="name" class="form-control" placeholder="Name" value="{{$form['name'] ?? ''}}">
    </div>
    <div class="form-group">
        <input type="text" name="photoUrls" class="form-control" placeholder="photo url, photo url, ..."
            value="{{$form['photoUrls'] ?? ''}}">
    </div>
    <div class="form-group">
        <input type="text" name="tags" class="form-control" placeholder="Tags 1, Tag 2, ..." value="{{$form['tags'] ?? ''}}">
    </div>
    <div class="form-group">
        <select class="form-control" name="status">
            @foreach ($form['availiablePetStatus'] as $status)
                <option value="{{$status}}" {{($form['status'] === $status) ? 'selected' : '';}}>{{$status}}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

@section('content')
@if (isset($form['id']))
<h1>Update Pet {{$form['id']}}</h1>
@else
<h1>Create Pet</h1>
@endif
@endsection