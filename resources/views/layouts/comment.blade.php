@foreach ($comments as $comment)
                <div class="mt-3 p-3 border rounded ms-3 me-3 " style="direction: rtl">
                    <p>نام کاربر : {{ $comment->user->name }}</p>
                    <p>نظر : {{ $comment->comment }} </p>
                    <p>تاریخ ساخت : {{ jdate($comment->created_at)->ago() }}</p>
                    @auth
                    @if($comment->user_id == auth()->user()->id)
                    <button class="btn btn-danger">حذف نظر</button>
                    <button class="btn btn-primary">ویرایش نظر</button>
                    @endauth
                    @endif
                    @auth
                    <button class="btn btn-warning" style="color: white" data-toggle="collapse" data-target="#demo{{ $comment->id }}">افزودن پاسخ</button>
                    <div id="demo{{ $comment->id }}" class="collapse">
                        <h5 class="mt-2 me-3">لطفا نظر خود را وارد کنید ...</h5>
                        <form action="{{ route('home.product.comment',$product->id) }}" method="POST" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">نظر شما ...</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-success me-3" value="ثبت نظر">
                            </form>
                      </div>
                    @endauth
                    @include('layouts.comment',['comments'=>$comment->child])
                </div>    
            @endforeach


            {{-- @foreach ($comment->child as $commentChild)
                    <div class="mt-3 p-3 border rounded ms-3 me-3">
                        <p>نام کاربر : {{ $commentChild->user->name }}</p>
                        <p>نظر : {{ $commentChild->comment }} </p>
                        <p>تاریخ ساخت : {{ $commentChild->created_at }}</p>
                        @if($commentChild->user_id == auth()->user()->id)
                        <button class="btn btn-danger">حذف نظر</button>
                        <button class="btn btn-primary">ویرایش نظر</button>
                        @endif
                        @auth
                        {{-- <button class="btn btn-warning">افزودن پاسخ</button> --}}
                        {{-- @endauth --}}
                    {{-- </div> --}}
                    {{-- @endforeach --}} 