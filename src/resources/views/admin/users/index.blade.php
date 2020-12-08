@extends('layouts.dashboard')

@section('content')

    <div class="card text-right" dir="rtl">
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
