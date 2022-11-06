@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="text-align: right;direction:rtl">
            @foreach ($products as $product)
            <div class="card m-2 p-2" style="width: 18rem;display:inline-block">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">{{ $product->title }}</h5>
                  <p class="card-text">{{ mb_substr($product->description,0,130) . ' ...' }}</p>
                  <a href="{{ route('home.product.show',$product->id) }}" class="btn btn-primary">نمایش محصول</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
