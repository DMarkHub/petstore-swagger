@extends('layouts.app')

@section('form')
<form method="post">
    @csrf
    <div class="form-group">
        <input type="number" name="petId" class="form-control" placeholder="Pet ID">
    </div>
    <div class="form-group">
        <input type="number" name="quantity" class="form-control" placeholder="Quantity">
    </div>
    <div class="form-group">
        <input type="date" name="shipDate" class="form-control" placeholder="Ship Date">
    </div>
    <div class="form-group">
        <select class="form-control" name="status">
            @foreach ($form['availiableOrderStatus'] as $status)
                <option value="{{$status}}">{{$status}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <input type="checkbox" class="form-check-input" id="complete" name="complete">
        <label class="form-check-label" for="complete">Complete</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

@section('content')
<h1>Create order</h1>
@endsection