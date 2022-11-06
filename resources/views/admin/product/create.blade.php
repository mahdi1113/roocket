@component('admin.layout.content',['title'=>'ساخت محصولات'])

@slot('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">محصولات</a></li>
<li class="breadcrumb-item">ساخت محصولات</li>
@endslot
<div class="col-md-12">
    <!-- Horizontal Form -->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">ساخت محصولات</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('admin.product.store') }}" method="POST" class="form-horizontal">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">عنوان</label>

            <div class="col-sm-12">
              <input type="text" name="title" class="form-control" id="inputEmail3" placeholder="عنوان محصول خود را وارد کنید">
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">قیمت</label>

            <div class="col-sm-12">
              <input type="text" name="price" class="form-control" id="inputEmail3" placeholder="قیمت محصول">
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">موجودی</label>

            <div class="col-sm-12">
              <input type="text" name="inventory" class="form-control" id="inputEmail3" placeholder="موجودی محصول را وارد کنید">
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">توضیحات</label>

            <div class="col-sm-12">
              <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
          </div>

          <div class="from-group">
            <select class="form-control" name="categories[]" multiple>
              @foreach (App\Models\Category::all() as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-info">ثبت محصول</button>
          <a href="{{ route('admin.product.index') }}" type="submit" class="btn btn-default float-left">لغو</a>
        </div>
        <!-- /.card-footer -->
      </form>
    </div>
    <!-- /.card -->
    <!-- general form elements disabled -->
   
    <!-- /.card -->
  </div>
@endcomponent