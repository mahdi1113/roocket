@component('admin.layout.content',['title'=>'کاربران'])

@slot('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item">کاربران</li>
@endslot

    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">کاربران</h3>
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
              @can('user_create')
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary mr-2">ساخت کاربر</a>    
              @endcan
            </div>
            <div>
              @can('show_staff_user')
                <a href="{{ request()->fullUrlWithQuery(['admin' => 1]) }}" class="btn btn-warning mr-2">کاربران ادمین</a>    
              @endcan
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover">
            <thead>
              <tr>
              <th>آی دی کاربر</th>
              <th>نام کاربر</th>
              <th>ایمیل</th>
              <th>وضعیت ایمیل</th>
              <th>اقدامات</th>
            </tr>
            </thead>
            @forelse ($users as $user)
            <tbody>
            <tr>
              <td>{{ $user->id }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                @if($user->email_verified_at)
                  <span class="badge badge-success">فعال</span>
                @else
                <span class="badge badge-danger">غیر فعال</span>
                @endif
              </td>
              <td style="display: flex">
                @can('user_edit')
                  <a class="btn btn-sm btn-primary ml-1" href="{{ route('admin.users.edit',$user->id) }}">آپدیت</a>    
                @endcan
                
                @can('staff_user_permissions')
                  <a class="btn btn-sm btn-warning ml-1" href="{{ route('admin.user.permission.create',$user->id) }}">دسترسی</a>
                @endcan
                @can('user_delete')
                  <form action="{{ route('admin.users.destroy',$user->id) }}" method="POST">
                    @csrf
                    @method('Delete')
                    <button class="btn btn-danger btn-sm">حذف</button>
                  </form>
                @endcan
                
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
        {!! $users->appends($_GET)->render() !!}
    </div>
    </div>
@endcomponent