@component('admin.layout.content',['title'=>'دسترسی ها'])

@slot('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item">دسترسی ها</li>
@endslot

    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">دسترسی ها</h3>
          <div class="card-tools d-flex">
            <div class="input-group input-group-sm" style="width: 150px;">
              <form action="" style="display: flex">
                <input type="text" name="search" class="form-control float-right" placeholder="جستجو" value="{{ request('search') }}">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </form>
            </div>
            <div>
              <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary mr-2">ساخت دسترسی</a>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover">
            <thead>
              <tr>
              <th>نام دسترسی</th>
              <th>توضیح دسترسی</th>
              <th>اقدامات</th>
            </tr>
            </thead>
            @forelse ($permissions as $permission)
            <tbody>
            <tr>
              <td>{{ $permission->name }}</td>
              <td>{{ $permission->label }}</td>
              <td style="display: flex">
                <a class="btn btn-sm btn-primary ml-1" href="{{ route('admin.permissions.edit',$permission->id) }}">آپدیت</a>
                <form action="{{ route('admin.permissions.destroy',$permission->id) }}" method="POST">
                  @csrf
                  @method('Delete')
                  <button class="btn btn-danger btn-sm">حذف</button>
                </form>
              </td>
            </tr>
          </tbody>
          @empty
          <tr>
            <td class="badge badge-danger m-3">نتیجه ای نداشت</td>
          </tr>
          @endforelse  
        </table>
        
        </div>
        <!-- /.card-body -->
        
      </div>
      <!-- /.card -->
      <div class="d-flex justify-content-center">
        {!! $permissions->appends($_GET)->render() !!}
    </div>
    </div>
@endcomponent