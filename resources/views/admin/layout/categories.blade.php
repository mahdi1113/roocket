<ul class="list-group list-group-flush">
    @foreach($categories as $cate)
        <li class="list-group-item">
            <div class="d-flex">
                <span>{{ $cate->name }}</span>
                <div class="actions mr-2">
                    <form action="{{ route('admin.categories.destroy', $cate->id) }}" id="cate-{{ $cate->id }}-delete" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-sm">حذف</button>
                    </form>
                    <a href="{{ route('admin.categories.edit' , $cate->id) }}" class="badge badge-primary">ویرایش</a>
                    <a href="{{ route('admin.categories.create') }}?parent={{ $cate->id }}" class="badge badge-warning">ثبت زیر دسته</a>
                </div>
            </div>
            @if($cate->child->count())
                @include('admin.layout.categories' , [ 'categories' => $cate->child])
            @endif
        </li>
    @endforeach
</ul>
