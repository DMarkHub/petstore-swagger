@extends('layouts.app')


@section('form')
<form method="post">
    @csrf
    <div class="form-group">
        <input type="number" name="id" class="form-control" placeholder="Order ID">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

@section('content')
<h1>Order</h1>
@endsection