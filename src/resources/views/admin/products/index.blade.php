@extends('layouts.dashboard')

@section('content')

    <div class="card text-right" dir="rtl">
        <div class="card-body">
            <div class="row">
                <h4 class="header-title col"><i class="ti-archive px-2"></i>المنتجات</h4>
                <a href="{{route('admin.products.create')}}">
                    <button type="button" class="btn btn-primary mb-3 mx-3">اضافة منتج<i
                            class="ti-plus mx-1 font-weight-bolder" style="vertical-align: middle"></i></button>
                </a>
            </div>
            <data-table-component
                url="{{route('api.products.index')}}"
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
                },
                {
                    label: '',
                    classes: {
                    'btn': true,
                    'btn-info': true,
                    'text-white': true,
                    'btn-sm': true, },
                    event: 'click',
                    handler: this.editRow,
                    component: 'edit-button-component',
                },
                                {
                    label: '',
                    classes: {
                    'btn': true,
                    'btn-danger': true,
                    'btn-sm': true, },
                    event: 'click',
                    handler: this.deleteRow,
                    component: 'delete-button-component',
                },
            ]">

            </data-table-component>
        </div>
    </div>


@endsection
