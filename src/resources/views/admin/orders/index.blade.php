@extends('layouts.dashboard')

@section('content')

    <div class="card text-right" dir="rtl">
        <div class="card-body">
            <div class="row">
                <h4 class="header-title col"><i class="ti-check-box px-2"></i>الطلبات</h4>
            </div>
            <div class="datatable-dark">
                <data-table-component
                    url="{{route('admin.orders.data')}}"
                    v-bind:columns="[
                {
                    label: 'رقم الطلب',
                    name: 'id',
                    orderable: true,
                },
                {
                    label: 'اسم الزبون',
                    name: 'user.name',
                    orderable: true,
                },
                {
                    label: 'العنوان',
                    name: 'address',
                },
                {
                    label: 'رقم الهاتف',
                    name: 'phone',
                },
                {
                    label: 'المبلغ الكلي',
                    name: 'total_price',
                    orderable: true,
                },
                {
                    label: 'التاريخ والوقت',
                    name: 'published',
                    orderable: true,
                },
                {
                    label: 'حالة الطلب',
                    name: 'status',
                },
                {
                    label: '',
                    classes: {
                    'btn': true,
                    'btn-primary': true,
                    'btn-sm': true, },
                    event: 'click',
                    handler: this.viewRow,
                    component: 'view-button-component',
                },
            ]">
                </data-table-component>
            </div>
        </div>
    </div>

@endsection
