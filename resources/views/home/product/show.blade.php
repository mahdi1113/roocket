@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="text-align: right;direction:rtl">
            <h4 class="mb-3">{{ $product->title }}</h4>
            <span class="badge badge-info"> تعداد بازدید : {{ $product->view_count }}</span>
            <span class="badge badge-success me-3 mt-2 mb-3">تعداد موجود : {{ $product->inventory }}</span>
            <p style="line-height:3em">{{ $product->description }}</p>
        </div>
        
        <div class="col-md-8 border p-2 rounded" style="direction: rtl">
            @auth
            <h5 class="mt-2 me-3">لطفا نظر خود را وارد کنید ...</h5>
            <form action="{{ route('home.product.comment',$product->id) }}" method="POST" class="form-horizontal">
                @csrf
                <input type="hidden" name="parent_id" value="0">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">نظر شما ...</label>
        
                    <div class="col-sm-12">
                      <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>
                <input type="submit" class="btn btn-success me-3" value="ثبت نظر">
            </form>
            @endauth
            @guest
            <h5 class="mt-2 me-3">برای ثبت نظر وارد شوید ...</h5>
            @endguest
            @include('layouts.comment',['comments'=> $product->comments()->where('parent_id',0)->latest()->get()])

        </div>   
    </div>
</div>  
                
@endsection
