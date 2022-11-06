@component('admin.layout.content',['title'=>'ساخت کاربر'])

@slot('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">کاربران</a></li>
<li class="breadcrumb-item">ساخت کاربر</li>
@endslot
<div class="col-md-12">
    <!-- Horizontal Form -->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">ساخت کاربر</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('admin.users.store') }}" method="POST" class="form-horizontal">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">نام</label>

            <div class="col-sm-12">
              <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="نام خود را وارد کنید">
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">ایمیل</label>

            <div class="col-sm-12">
              <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="ایمیل را وارد کنید">
            </div>
          </div>
          
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">پسورد</label>

            <div class="col-sm-12">
              <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="رمز عبور خود را وارد کنید">
            </div>
          </div>

          
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">تکرار پسورد</label>

            <div class="col-sm-12">
              <input type="password" name="password_confirmation" class="form-control" id="inputEmail3" placeholder="تکرار رمز عبور">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="form-check">
                <input type="checkbox" name="verify" class="form-check-input" id="exampleCheck2">
                <label class="form-check-label" for="exampleCheck2">ایمیل فعال باشد</label>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-info">ثبت کاربر</button>
          <a href="{{ route('admin.users.index') }}" type="submit" class="btn btn-default float-left">لغو</a>
        </div>
        <!-- /.card-footer -->
      </form>
    </div>
    <!-- /.card -->
    <!-- general form elements disabled -->
   
    <!-- /.card -->
  </div>
@endcomponent