@extends('layouts.app')

@section('style')
    <style>
        .metismenu li a span {
            font-family: 'Tajawal', sans-serif !important;
        }
    </style>
@endsection
@section('spa')
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <a href="{{route('admin.admin')}}"><h4 style="color: #fff">Jamila & Shorjah</h4></a>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li class="{{ request()->segment(2) === null ? 'active' : null }}"><a
                                    href="{{route('admin.admin')}}"><i class="ti-dashboard"></i>
                                    <span><strong>الرئيسية</strong></span></a></li>
                            <li class="{{ request()->segment(2) === 'products' ? 'active' : null }}"><a
                                    href="{{route('admin.products.index')}}"><i class="ti-archive"></i> <span><strong>المنتجات</strong></span></a>
                            </li>
                            <li class="{{ request()->segment(2) === 'categories' ? 'active' : null }}"><a
                                    href="{{route('admin.categories.index')}}"><i class="ti-layout-grid2"></i>
                                    <span><strong>الفئات</strong></span></a></li>
                            <li class="{{ request()->segment(2) === 'adverts' ? 'active' : null }}"><a
                                    href="{{route('admin.adverts.index')}}"><i class="ti-dashboard"></i> <span><strong>الاعلانات</strong></span></a>
                            </li>
                            <li class="{{ request()->segment(2) === 'users' ? 'active' : null }}"><a
                                    href="{{route('admin.users.index')}}"><i class="ti-user"></i> <span><strong>المستخدمين</strong></span></a>
                            </li>
                            <li class="{{ request()->segment(2) === 'orders' ? 'active' : null }}"><a
                                    href="{{route('admin.orders.index')}}"><i class="ti-check-box"></i> <span><strong>الطلبات</strong></span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right float-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                            <li class="settings-btn">
                                <i class="ti-settings dropdown-toggle" data-toggle="dropdown"></i>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log Out</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <div class="main-content-inner mt-5">
                @if(session()->has('message'))
                    <div class="alert alert-success text-right" style="font-size: 16px">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger text-right" style="font-size: 16px">
                        {{ session()->get('error') }}
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Genius Solutions 2020. All right reserved.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
@endsection

@section('scripts')
    @yield('script')
@endsection
