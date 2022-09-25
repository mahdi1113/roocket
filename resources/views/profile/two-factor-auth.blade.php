@extends('profile.layout')
@section('main')
<h5>your manage to factore :</h5>
@include('message')
<hr>
<form action="{{ route('profile.manageTwoFactor') }}" method="POST">
    @csrf
        <select name="type" class="form-select">
            @foreach (config('twoFactore.types') as $key => $value)
                <option class="form-control" value="{{ $key }}" {{auth()->user()->two_factore_type == $key ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>

    <div class="form-group mt-3">
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') ?? Auth::user()->phone_number }}">
    </div>

    <div class="form-group">
        <button class="btn btn-primary mt-2">
            update
        </button>
    </div>

</form>
@endsection