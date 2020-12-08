@extends('layouts.dashboard')

@section('content')

    <div class="card text-right" dir="rtl">
        <div class="card-body">
            <h4 class="header-title">تعديل منتج</h4>
            <form action="{{route('admin.products.update', ['product' => $product->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">اسم المنتج</label>
                    <input type="text" class="form-control" id="name" name="title" value="{{$product->title}}" placeholder="ادخل اسم المنتج" required>
                </div>
                <div class="form-group">
                    <label for="sku"> رقم التخزين SKU</label>
                    <input type="number" class="form-control" name="sku" value="{{$product->sku}}" id="sku" placeholder="0000" required>
                </div>
                <div class="form-group">
                    <label for="description">تفاصيل المنتج</label>
                    <textarea class="form-control" name="description" id="description" rows="4"
                              placeholder="ادخل تفاصيل المنتج">{{$product->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="description">اضافة صورة</label>
                    <div class="drop">
                        <div class="uploader">
                            <label class="drop-label">اضف صورة يدوياً او عن طريق السحب والإفلات</label>
                            <input type="file" class="image-upload"id="photo" name="photo" accept="image/*">
                        </div>
                        <div id="image-preview" style="width: 350px;">
                            <img src="{{@Storage::disk('public')->url('app/public/images/products/'. $product->image)}}" style="margin-top:20px">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category">الفئة</label>
                    <div class="col-lg-4">
                        <div class="categories mCustomScrollbar _mCS_6"
                             data-rel="scroll"
                             data-scrollheight="200">
                        </div>
                        <select id="category" name="category"
                                class="selectpicker"
                                data-live-search="true">
                            @foreach($categories as $category)
                                <option class="text-right"
                                        value="{{$category->id}}"
                                    {{$category_product === $category->id ? 'selected' : ''}}
                                >{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price">سعر المنتج بالدينار</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{$product->price}}" placeholder="ادخل سعر المنتج" required>
                </div>
                <div class="form-group">
                    <label for="quantity">الكمية</label>
                    <input type="number" class="form-control" name="quantity" value="{{$product->quantity}}" id="quantity" placeholder="0" required>
                </div>
                <div class="form-group">
                    <label for="box-items">عدد القطع في الصندوق الواحد</label>
                    <input type="number" class="form-control" name="box_items" value="{{$product->box_items}}" id="box-items" placeholder="0" required>
                </div>
                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">حفظ المنتج <i class="ti-save mx-1 font-weight-bolder" style="vertical-align: middle"></i></button>
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
            $('.selectpicker').selectpicker();
        });
    </script>
@endsection

@section('meta')
    <meta http-equiv="Pragma" content=”no-cache”>
    <meta http-equiv="Expires" content="-1">
    <meta http-equiv="CACHE-CONTROL" content="NO-CACHE">
@endsection
