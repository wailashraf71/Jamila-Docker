@extends('layouts.dashboard')

@section('content')
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <div class="sales-report-area sales-style-two text-right">
        <div class="row">
            <div class="col-lg-3 col-md-6 pb-2"><div class="card">
                    <div class="card-body px-4" style="padding: 1.5em;">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="ti-check-box" style="color: #7801ff"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">{{$orders_count}}</span></div>
                                    <div class="stat-heading"><b>الطلبات</b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div></div>
            <div class="col-lg-3 col-md-6 pb-2"><div class="card">
                    <div class="card-body px-4" style="padding: 1.5em;">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="ti-user" style="color: #7801ff"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">{{$users_count}}</span></div>
                                    <div class="stat-heading"><b>المستخدمين</b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div></div>
            <div class="col-lg-3 col-md-6 pb-2"><div class="card">
                    <div class="card-body px-4" style="padding: 1.5em;">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="ti-layout-grid2" style="color: #7801ff; vertical-align: middle"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">{{$categories_count}}</span></div>
                                    <div class="stat-heading"><b>الفئات</b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div></div>
            <div class="col-lg-3 col-md-6 pb-2"><div class="card">
                    <div class="card-body" style="padding: 1.5em;">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="ti-archive" style="color: #7801ff"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">{{$products_count}}</span></div>
                                    <div class="stat-heading"><b>المنتجات</b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div></div>
        </div>
    </div>

    <div class="card mt-5 text-right" dir="rtl">
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
            ]">

            </data-table-component>
        </div>
    </div>
    <div class="card mt-5 text-right" dir="rtl">
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
                    orderable: true,
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
    <div class="card mt-5 text-right" dir="rtl">
        <div class="card-body">
            <div class="row">
                <h4 class="header-title col"><i class="ti-user px-2"></i>المستخدمين</h4>
            </div>
            <data-table-component
                url="{{route('admin.users.data')}}"
                v-bind:columns="[
                {
                    label: '#',
                    name: 'id',
                    orderable: true,
                },
                {
                    label: 'الاسم',
                    name: 'name',
                    orderable: true,
                },
                {
                    label: 'البريد الالكتروني',
                    name: 'email',
                },
                {
                    label: 'تاريخ الانضمام',
                    name: 'published',
                    orderable: true,
                },
            ]">

            </data-table-component>
        </div>
    </div>

@endsection
