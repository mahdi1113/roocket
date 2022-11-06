@component('admin.layout.content',['title'=>'ساخت دسته'])

@slot('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">دسته</a></li>
<li class="breadcrumb-item">ساخت دسته</li>
@endslot
<div class="col-md-12">
    <!-- Horizontal Form -->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">ساخت دسته</h3>
      </div> 
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('admin.categories.store') }}" method="POST" class="form-horizontal">
        @csrf

        @if (request('parent'))
            @php
              $parent = App\Models\Category::find(request('parent'));
            @endphp
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label mt-3">نام دسته پدر</label>
  
              <div class="col-sm-12">
                <input type="text" name="name" class="form-control" id="inputEmail3" disabled value="{{ $parent->name }}">
                <input type="hidden" name="parent" class="form-control" value="{{ $parent->id }}">
              </div>
            </div>
        @endif

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label mt-3">نام زیر دسته</label>

            <div class="col-sm-12">
              <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="نام دسته خود را وارد کنید">
            </div>
          </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-info">ثبت دسته</button>
          <a href="{{ route('admin.categories.index') }}" type="submit" class="btn btn-default float-left">لغو</a>
        </div>
        <!-- /.card-footer -->
      </form>
    </div>
    <!-- /.card -->
    <!-- general form elements disabled -->
   
    <!-- /.card -->
  </div>
@endcomponent