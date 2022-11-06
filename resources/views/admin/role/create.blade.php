@component('admin.layout.content',['title'=>'ساخت نقش ها'])

@slot('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">نقش ها</a></li>
<li class="breadcrumb-item">ساخت نقش</li>
@endslot
<div class="col-md-12">
    <!-- Horizontal Form -->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">ساخت نقش</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('admin.roles.store') }}" method="POST" class="form-horizontal">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">نام</label>

            <div class="col-sm-12">
              <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="نام دسترسی خود را وارد کنید">
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">توضیحات</label>

            <div class="col-sm-12">
              <input type="text" name="label" class="form-control" id="inputEmail3" placeholder="توضیحات دسترسی را وارد کنید">
            </div>
          </div>

          <div class="from-group">
            <select class="form-control" name="permissions[]" multiple>
              @foreach ($permissions as $permission)
                  <option value="{{ $permission->id }}">{{ $permission->name }}</option>
              @endforeach
            </select>
          </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-info">ثبت نقش</button>
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