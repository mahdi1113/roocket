@component('admin.layout.content',['title'=>'کامنت های تایید نشده'])

@slot('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item">کامنت های تایید نشده</li>
@endslot

    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">کامنت های تایید نشده</h3>
          <div class="card-tools d-flex">
            <div class="input-group input-group-sm" style="width: 150px;">
              <form action="" style="display: flex">
                <input type="text" name="search" class="form-control float-right" placeholder="جستجو" value="{{ request('search') }}">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover">
            <thead>
              <tr>
              <th>نام سازنده</th>
              <th>متن کامنت</th>
              <th>آپدیت</th>
              <th>حذف</th>
            </tr>
            </thead>
            @forelse ($comments as $comment)
            <tbody>
            <tr>
              <td>{{ $comment->user->name }}</td>
              <td>{{ $comment->comment }}</td>
              <td><a href="{{ route('admin.comments.updateUnApproved',$comment->id) }}" class="badge badge-warning">تایید نشده</a></td>
              <td style="display: flex">
                {{-- <a class="btn btn-sm btn-primary ml-1" href="{{ route('comments.updateUnApproved',$comment->id) }}">آپدیت</a> --}}
                <form action="{{ route('admin.comments.destroy',$comment->id) }}" method="POST">
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
        {!! $comments->appends($_GET)->render() !!}
    </div>
    </div>
@endcomponent