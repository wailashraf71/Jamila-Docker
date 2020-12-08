<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Fonts -->
{{--    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>--}}

<!-- Styles -->
    <style>
        body, .header-title, .btn ,.modal-body, p, span{
            font-family: 'Tajawal', sans-serif !important;
        }
        .stat-widget-five .stat-icon {
            font-size: 50px;
            line-height: 50px;
            position: absolute;
            left: 30px;
            top: 20px;
        }

        .form-gp i {
            left: 5px !important;
        }
        .form-gp label {
            right: 0 !important;
            left: 0 !important;
        }
        .stat-widget-five .stat-content {
            margin-left: 100px;
        }
        .stat-widget-five .stat-text {
            color: #455a64;
            font-size: 20px;
        }
        .stat-widget-five .stat-heading {
            color: #99abb4;
            font-size: 14px;
        }
        .form-control::placeholder {
            opacity: 0.6 !important;
            font-weight: 400 !important;
        }
        select.form-control{
            padding: 0 !important;
        }
        .d-flex.justify-content-between{
            direction: ltr !important;
        }
        .fa-btn {
            margin-right: 6px;
        }

        .drop {
            background-color: #fff;
        }

        .drop:after {
            border: dashed 0.3rem rgba(0, 0, 0, 0.0875);
        }

        .drop .drop-label {
            color: rgba(0, 0, 0, 0.25);
        }

        .drop:hover:after {
            border-color: rgba(0, 0, 0, 0.125);
        }

        .drop:hover .drop-label {
            color: rgba(0, 0, 0, 0.125);
        }

        #image-preview, .image-preview {
            background-color: #000;
        }

        .drop {
            min-width: 200px;
            width: 350px;
            min-height: 12rem;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            margin: 0;
        }

        .drop:after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
        }

        .drop.file-focus {
            border: 0;
        }

        .drop:hover {
            cursor: pointer;
        }

        .drop .drop-label {
            font-size: 1.0rem;
            font-weight: 500;
            line-height: 4rem;
            width: 32rem;
            text-align: center;
            position: absolute;
            top: 50%;
            margin-top: -1.5rem;
            left: 50%;
            margin-left: -16rem;
        }

        .drop input[type=file] {
            line-height: 50rem;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            z-index: 10;
            cursor: pointer;
        }

        #image-preview, .image-preview {
            width: 100%;
            display: block;
            position: relative;
            z-index: 1;
        }

        #image-preview:empty, .image-preview:empty {
            display: none;
        }

        #image-preview img, .image-preview img {
            display: block;
            margin: 0 auto;
            width: 100%
        }

        #image-preview:after, .image-preview:after {
            content: "";
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
            border: solid 0.1rem rgba(0, 0, 0, 0.08);
            background: bottom center repeat-x url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAABfCAMAAAAeT108AAABEVBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABoX7lMAAAAW3RSTlMBCHwGAwQFCgIMCw4PERITFBYXGRoNHR4gISIlJicpKiwuLzEzNDY3OTs8G0BBQ0VGSEpLTU9QUVRVVlhZW11eX2FiZGVmaGlrbG1ucHFyc3R1dnd4eXp7Pn1+eLXrxAAAADRJREFUCFtjYAACDmYGJkYmRiDJAMJMbEzMTP+ZeJgZmTChOFZR7FAPYi71IQMT0JXhTIwAN8YCxDyw89IAAAAASUVORK5CYII=);
        }

        .bootstrap-select .dropdown-toggle .filter-option {
            text-align: right !important;
        }
    </style>

    <title>Jamila & Shorjah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/icon/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/slicknav.min.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- amchart css -->
{{--    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />--}}
<!-- others css -->
    <link rel="stylesheet" href="{{asset('assets/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">

    @yield('style')
</head>
<body id="app-layout">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a
    href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<div id="app">
    @yield('spa')
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <div id="format"></div>
</div>
<!-- JavaScripts -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- bootstrap 4 js -->
<script src="{{asset('assets/js/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.slicknav.min.js')}}"></script>
<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<!-- others plugins -->
<script src="{{asset('assets/js/plugins.js')}}"></script>
<script src="{{asset('assets/js/scripts.js')}}"></script>

@yield('scripts')
</body>
</html>
