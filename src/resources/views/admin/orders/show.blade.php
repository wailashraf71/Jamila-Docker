@extends('layouts.dashboard')

@section('content')

    <div class="card text-right" dir="rtl">
        <div class="card-body">
            <div class="invoice-area">
                <div class="invoice-head">
                    <div class="row">
                        <div class="iv-left col-11">
                            <span>تفاصيل الطلب</span>
                            <span class="px-2 {{$order->accepted > 0 ? 'text-success' : 'd-none'}}" >  تمت الموافقة</span>
                        </div>
                        <div class="iv-right col-1 text-md-right">
                            <span>#{{$order->id}}</span>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="invoice-address">
                            <div class="row col" style="vertical-align: middle">
                                <p class="col" style="font-size: 17px">اسم الزبون: </p>
                                <p class="px-3 col" style="font-size: 17px"><b>{{$order->user->name}}</b></p>
                            </div>
                            <div class="row col" style="vertical-align: middle">
                                <p class="col" style="font-size: 17px">العنوان: </p>
                                <p class="px-3 col" style="font-size: 17px"><b>{{$order->address}}</b></p>
                            </div>
                            <div class="row col" style="vertical-align: middle">
                                <p class="col" style="font-size: 17px">رقم الهاتف: </p>
                                <p class="px-3 col" style="font-size: 17px"><b>{{$order->phone}}</b></p>
                            </div>
                            <div class="row col" style="vertical-align: middle">
                                <p class="col" style="font-size: 17px">المبلغ الكلي: </p>
                                <p class="px-3 col" style="font-size: 17px"><b>{{$order->total_price}} د.ع</b></p>
                            </div>
                            <div class="row col" style="vertical-align: middle">
                                <p class="col" style="font-size: 17px">التاريخ: </p>
                                <p class="px-3 col" style="font-size: 17px">
                                    <b>{{$order->created_at == null? null :$order->created_at->format('Y/m/d')}}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="invoice-table table-responsive mt-5">
                    <table class="table table-bordered table-hover text-right">
                        <thead>
                        <tr class="text-capitalize">
                            <th class="text-center" style="width: 5%;">#</th>
                            <th class="text-right" style="width: 25%; min-width: 130px;">اسم المنتج</th>
                            <th>الكمية</th>
                            <th style="min-width: 100px">سعر المنتج</th>
                            <th>السعر الكلي</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->products as $product)
                            <tr>
                                <td class="text-center">{{$product->id}}</td>
                                <td class="text-right">{{$product->title}}</td>
                                <td>{{$product->pivot->quantity}}</td>
                                <td>{{$product->price}} د.ع</td>
                                <td>{{$product->pivot->quantity * $product->price}} د.ع</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="pt-3" style="border-top: 2px solid #d8d8d8;">
                        <tr>
                            <td colspan="4">الكمية الكلية او عدد القطع :</td>
                            <td><i class="ti-package px-2" style="vertical-align: middle;"></i>  {{$order_total_quantity}}</td>
                        </tr>
                        <tr>
                            <td colspan="4">التكلفة الكلية :</td>
                            <td>{{$order_total_price}} د.ع</td>
                        </tr>
                        <tr>
                            <td colspan="4">التكلفة الكلية عند الزبون :</td>
                            <td>{{$order->total_price}} د.ع</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <br>
            <br>
            <div class="invoice-buttons text-right">
                <form id="dynForm" style="display: inline-block" action="{{route('admin.orders.update', ['order' => $order->id])}}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="accepted" value="{{$order->accepted}}">
                    <button class="btn p-0 {{$order->accepted > 0 ? 'btn-danger ': 'bg-transparent'  }}" type="submit"><a class="{{$order->accepted > 0 ? 'bg-transparent': 'invoice-btn'  }}"><p class="text-white">{{$order->accepted > 0 ? 'الغاء الطلب' : 'قبول الطلب'}}</p></a></button>
                </form>
                <a href="#" class="bg-transparent">
                    <button class="btn bg-transparent" data-toggle="modal" data-target="#deleteModal" title="Update"><p class="text-danger"><i class="ti-trash px-1" style="vertical-align: middle"></i>حذف الطلب</p></button>
                </a>
            </div>
            <!-- Delete Modal -->
            <div class="modal fade text-left" id="deleteModal" tabindex="-1" role="dialog"
                 aria-labelledby="mediumModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p class="modal-title px-2" id="mediumModalLabel" style="font-size: 18px"><b>حذف الطلب</b></p>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-right">
                            <p>
                                حذف هذا الطلب من قاعدة البيانات؟
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-disabled" data-dismiss="modal">رجوع</button>
                            <form id="dynForm" action="{{route('admin.orders.destroy', ['order' => $order->id])}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger"><p class="text-white">حذف الطلب</p></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
