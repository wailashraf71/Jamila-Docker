@extends('layouts.app')

@section('spa')
    <div class="error-area ptb--50 text-center">
        <div class="container">
            <div class="error-content">
                <h2>404</h2>
                <p>الصفحة التي تبحث عنها غير موجودة.</p>
                <a href="{{route('admin.admin')}}"><p class="text-white">رجوع الى القائمة الرئيسية</p></a>
            </div>
        </div>
    </div>
@endsection
