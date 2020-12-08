@extends('layouts.dashboard')

@section('content')

    <div class="card text-right" dir="rtl">
        <div class="card-body">
            <div class="row">
                <h4 class="header-title col">منتجات الفئة:   {{$category->title}}</h4>
            </div>
            <data-table-component
                url="{{route('api.categories.show', ['category' => $category->id])}}"
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
            ]">

            </data-table-component>
        </div>
    </div>


@endsection
