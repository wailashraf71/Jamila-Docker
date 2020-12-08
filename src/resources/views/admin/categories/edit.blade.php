@extends('layouts.dashboard')

@section('content')

    <div class="card text-right" dir="rtl">
        <div class="card-body">
            <h4 class="header-title">تعديل فئة</h4>
            <form action="{{route('admin.categories.update', ['category' => $category->id])}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">اسم الفئة</label>
                    <input type="text" class="form-control" id="name" name="title"
                           placeholder="ادخل اسم الفئة مثلا: حلويات" value="{{$category->title}}" required>
                </div>
                <div class="form-group">
                    <label for="description">اضافة صورة</label>
                    <div class="drop">
                        <div class="uploader">
                            <label class="drop-label">اضف صورة يدوياً او عن طريق السحب والإفلات</label>
                            <input type="file" class="image-upload" id="photo" name="photo" accept="image/*">
                        </div>
                        <div id="image-preview" style="width: 350px;">
                            <img src="{{@Storage::disk('public')->url('app/public/images/categories/'. $category->image)}}" style="margin-top:20px">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">تغيير الفئة <i
                        class="ti-save mx-1font-weight-bolder" style="vertical-align: middle"></i></button>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#photo').imageReader({
                onload: function (img) {
                    $(img).css('margin-top', '20px');
                }
            });
        });
    </script>
@endsection
@section('meta')
    <meta http-equiv="Pragma" content=”no-cache”>
    <meta http-equiv="Expires" content="-1">
    <meta http-equiv="CACHE-CONTROL" content="NO-CACHE">
@endsection

