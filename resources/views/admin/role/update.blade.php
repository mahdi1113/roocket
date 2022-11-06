@component('admin.layout.content',['title'=>'ویرایش نقش'])

@slot('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">نقش</a></li>
<li class="breadcrumb-item">ویرایش نقش</li>
@endslot
<div class="col-md-12">
    <!-- Horizontal Form -->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">ویرایش نقش</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('admin.roles.update',$role->id) }}" method="POST" class="form-horizontal">
        @csrf
        @method('put')
        <div class="card-body">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">نام</label>

            <div class="col-sm-12">
              <input type="text" name="name" class="form-control" id="inputEmail3" value="{{ old('name',$role->name) }}">
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">توضیحات</label>

            <div class="col-sm-12">
              <input type="text" name="label" class="form-control" id="inputEmail3" value="{{ old('label',$role->label) }}">
            </div>
          </div>

          <div class="from-group">
            <select class="form-control" name="permissions[]" multiple>
              @foreach ($permissions as $permission)
                  <option <?php echo in_array($permission->id , $role->permissions->pluck('id')->toArray()) ? 'selected' : '' ?> value="{{ $permission->id }}">{{ $permission->name }}</option>
              @endforeach
            </select>
          </div>
         
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-info">ویرایش نقش</button>
          <a href="{{ route('admin.roles.index') }}" type="submit" class="btn btn-default float-left">لغو</a>
        </div>
        <!-- /.card-footer -->
      </form>
    </div>
    <!-- /.card -->
    <!-- general form elements disabled -->
   
    <!-- /.card -->
  </div>
@endcomponent