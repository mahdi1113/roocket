@component('admin.layout.content',['title'=>'ویرایش دسترسی'])

@slot('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">دسترسی</a></li>
<li class="breadcrumb-item">ویرایش دسترسی</li>
@endslot
<div class="col-md-12">
    <!-- Horizontal Form -->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">ویرایش دسترسی</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('admin.permissions.update',$permission->id) }}" method="POST" class="form-horizontal">
        @csrf
        @method('put')
        <div class="card-body">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">نام</label>

            <div class="col-sm-12">
              <input type="text" name="name" class="form-control" id="inputEmail3" value="{{ old('name',$permission->name) }}">
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">توضیحات</label>

            <div class="col-sm-12">
              <input type="text" name="label" class="form-control" id="inputEmail3" value="{{ old('label',$permission->label) }}">
            </div>
          </div>
         
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-info">ویرایش کاربر</button>
          <a href="{{ route('admin.permissions.index') }}" type="submit" class="btn btn-default float-left">لغو</a>
        </div>
        <!-- /.card-footer -->
      </form>
    </div>
    <!-- /.card -->
    <!-- general form elements disabled -->
   
    <!-- /.card -->
  </div>
@endcomponent