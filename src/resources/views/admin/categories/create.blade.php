@extends('layouts.dashboard')

@section('content')

    <div class="card text-right" dir="rtl">
        <div class="card-body">
            <h4 class="header-title">اضافة فئة جديد</h4>
            <form action="{{route('admin.categories.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">اسم الفئة</label>
                    <input type="text" class="form-control" id="name" name="title" placeholder="ادخل اسم الفئة مثلا: حلويات" required>
                </div>
                <div class="form-group">
                    <label for="description">اضافة صورة</label>
                    <div class="drop">
                        <div class="uploader">
                            <label class="drop-label">اضف صورة يدوياً او عن طريق السحب والإفلات</label>
                            <input type="file" class="image-upload" id="photo" name="photo" accept="image/*" required>
                        </div>
                        <div id="image-preview" style="width: 350px;"></div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">حفظ الفئة <i class="ti-save mx-1 font-weight-bolder" style="vertical-align: middle"></i></button>
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

