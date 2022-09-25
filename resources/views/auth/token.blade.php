@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">
               Two Factor Auth
            <div class="card-body">
               <form action="{{ route('2fa.token') }}" method="POST">
                  @csrf

                  <div class="form-group">
                     <label for="token">Token</label>
                     <input type="text" class="form-control" name="token">
                  </div>

                  <div class="form-group mt-2">
                     <button class="btn btn-primary">Validate token</button>
                  </div>

               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
