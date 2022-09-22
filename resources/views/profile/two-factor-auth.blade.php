@extends('profile.layout')
@section('main')
<h5>your manage to factore :</h5>
@include('message')
<hr>
<form action="{{ route('profile.manageTwoFactor') }}" method="POST">
    @csrf
    
    <div class="form-group mt-3">
        <label for="type">Type</label>
        <select name="type" id="type" class="form-control">
            <option value="off">off</option>
            <option value="sms">sms</option>
        </select>
    </div>

    <div class="form-group mt-3">
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" class="form-control">
    </div>

    <div class="form-group">
        <button class="btn btn-primary mt-2">
            update
        </button>
    </div>

</form>
@endsection