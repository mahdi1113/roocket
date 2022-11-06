@component('admin.layout.content',['title'=>'ویرایش کامنت'])

@slot('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">کامنت</a></li>
<li class="breadcrumb-item">ویرایش کامنت</li>
@endslot
<div class="col-md-12">
    <!-- Horizontal Form -->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">ویرایش کامنت</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('admin.product.update',$product->id) }}" method="POST" class="form-horizontal">
        @csrf
        @method('put')
        <div class="card-body">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">عنوان</label>

            <div class="col-sm-12">
              <input type="text" name="title" class="form-control" id="inputEmail3" value="{{ old('title',$product->title) }}">
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">قیمت</label>

            <div class="col-sm-12">
              <input type="text" name="price" class="form-control" id="inputEmail3" value="{{ old('price',$product->price) }}">
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">موجودی</label>

            <div class="col-sm-12">
              <input type="text" name="inventory" class="form-control" id="inputEmail3" value="{{ old('inventory',$product->inventory) }}">
            </div>
          </div>

          <div class="form-group">
            <label for="exampleFormControlTextarea1">توضیحات</label>
            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ $product->description }}</textarea>
          </div>
         
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-info">ویرایش کامنت</button>
          <a href="{{ route('admin.product.index') }}" type="submit" class="btn btn-default float-left">لغو</a>
        </div>
        {{-- <!-- /.card-footer --}}
      </form>
    </div>
    <!-- /.card -->
    <!-- general form elements disabled -->
   
    <!-- /.card -->
  </div>
@endcomponent