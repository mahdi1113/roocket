@component('admin.layout.content',['title'=>'ایجاد دسترسی کاربران'])

@slot('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">کاربران</a></li>
<li class="breadcrumb-item">ایجاد دسترسی کاربران</li>
@endslot
@slot('script')
  <script>
    $('#roles').select2({
      'placeholder' : 'نقش مورد نظر را انتخاب کنید'
    });
    $('#permissions').select2({
      'placeholder' : 'دسترسی مورد نظر را انتخاب کنید'
    })
  </script>
@endslot
<div class="col-md-12">
    <!-- Horizontal Form -->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">ایجاد دسترسی کاربران</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('admin.user.permission.store',$user->id) }}" method="POST" class="form-horizontal">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <p class="badge badge-info">نام کاربر : {{ $user->name }}</p>
            <p class="badge badge-warning">ایمیل کاربر : {{ $user->email }}</p>
          </div>
          <div class="from-group">
            <label for="">نقش ها</label>
            <select class="form-control" name="roles[]" multiple id="roles">
              @foreach ($roles as $role)
                  <option value="{{ $role->id }}" <?php echo in_array($role->id,$user->roles->pluck('id')->toArray()) ? 'selected' : '' ?>>{{ $role->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="from-group mt-2">
            <label for="">دسترسی ها</label>
            <select class="form-control" name="permissions[]" multiple id="permissions">
              @foreach ($permissions as $permission)
                  <option value="{{ $permission->id }}" <?php echo in_array($permission->id,$user->permissions->pluck('id')->toArray()) ? 'selected' : '' ?>>{{ $permission->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-info">ثبت دسترسی</button>
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