@extends('layouts.dashboard')

@section('content')

    <div class="card text-right" dir="rtl">
        <div class="card-body">
            <div class="row">
                <h4 class="header-title col">منتجات الاعلان: {{$advert->title}}</h4>
                <a href="#" data-toggle="modal" data-target="#addModal">
                    <button type="button" class="btn btn-primary mb-3 mx-3">اضافة منتج<i
                            class="ti-plus mx-1 font-weight-bolder" style="vertical-align: middle"></i></button>
                </a>
            </div>
            <data-table-component
                url="{{route('api.adverts.show', ['advert' => $advert->id])}}"
                v-bind:columns="[
                {
                    label: '#',
                    name: 'id',
                    orderable: true,
                },
                {
                    label: 'اسم المنتج',
                    name: 'title',
                    orderable: true,
                },
                {
                    label: 'رقم التخزين',
                    name: 'sku',
                    orderable: true,
                },
                {
                    label: 'التفاصيل',
                    name: 'description',
                },
                {
                    label: 'الكمية المتبقية',
                    name: 'quantity',
                    orderable: true,
                }
            ]">

            </data-table-component>
        </div>
    </div>
            <!-- Add modal Modal -->
            <div class="modal fade text-left" id="addModal" tabindex="-1" role="dialog"
                 aria-labelledby="mediumModalLabel" aria-hidden="true" dir=rtl>
                 <form id="dynForm" action="{{route('admin.adverts.add', ['advert' => $advert->id])}}" method="post">
                    @csrf
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p class="modal-title px-2" id="mediumModalLabel" style="font-size: 18px"><b>حذف الطلب</b></p>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-right">
                                اختر المنتج الذي تود اضافته 
                                <select id="productItem" name="productItem"
                                    class="selectpicker"
                                    data-live-search="true">
                                @foreach($allproducts as $productItem)
                                    <option class="text-right"
                                        value="{{$productItem->id}}">{{$productItem->title}}</option>
                                @endforeach
                            </select>                
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-disabled" data-dismiss="modal">رجوع</button>
                
                                <button type="submit" class="btn btn-primary"><p class="text-white">اضافة المنتج</p></button>
                        </div>
                    </div>
                </div>
                 </form>
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
