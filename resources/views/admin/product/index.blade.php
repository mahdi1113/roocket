@component('admin.layout.content',['title'=>'محصولات'])

@slot('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item">محصولات</li>
@endslot

    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">محصولات</h3>
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
              <a href="{{ route('admin.product.create') }}" class="btn btn-primary mr-2">ساخت محصولات</a>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover">
            <thead>
              <tr>
              <th>نام محصول</th>
              <th>توضیحات محصول</th>
              <th>قیمت</th>
              <th>تعداد موجودی</th>
              <th>تعداد بازدید</th>
              <th>اقدامات</th>
            </tr>
            </thead>
            @forelse ($products as $product)
            <tbody>
            <tr>
              <td>{{ $product->title }}</td>
              <td>{{ $product->description }}</td>
              <td>{{ $product->price }}</td>
              <td>{{ $product->inventory }}</td>
              <td>{{ $product->view_count }}</td>
              <td style="display: flex">
                <a class="btn btn-sm btn-primary ml-1" href="{{ route('admin.product.edit',$product->id) }}">آپدیت</a>
                <form action="{{ route('admin.product.destroy',$product->id) }}" method="POST">
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
        {!! $products->appends($_GET)->render() !!}
    </div>
    </div>
@endcomponent