<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
         {{-- Font Awesome Icons --}}
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free-6.4.2/css/all.min.css') }}">
        {{-- iCheck --}}
        <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

        {{-- DATATABLES --}}
        <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

        {{-- Select2  --}}
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">


        {{-- daterange picker --}}
        <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">

        {{-- DatePicker --}}
        <link rel="stylesheet" href="{{ asset('plugins/datepicker/css/bootstrap-datepicker.min.css') }}">

        {{-- TAGINPUT --}}
        <link rel="stylesheet" href="{{ asset('plugins/Bootstrap-4-Tag-Input-Plugin-jQuery/tagsinput.css') }}">
        {{-- summernote --}}
        <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">

       {{-- Sweatalert --}}
       <link rel="stylesheet" href="{{ asset('plugins/bootstrap-sweetalert/dist/sweetalert.css') }}">
       
       {{-- Images Loader --}}
       <link rel="stylesheet" href="{{ asset('plugins/images-loader/jquery.imagesloader.css') }}">

       {{-- Ekko Lightbox --}}
       <link rel="stylesheet" href="{{ asset('plugins/ekko-lightbox/ekko-lightbox.css') }}">

        <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet">
        {{-- overlayScrollbars --}}
        <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

        <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet">
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            {{-- Navbar --}}
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <div class="nav-control">
                    <div class="hamburger" data-widget="pushmenu">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>
                </div>
                {{-- end Left navbar links --}}

                {{-- Right navbar links --}}
                <ul class="navbar-nav ml-auto">
                    {{-- Navbar Search --}}
                    <li class="nav-item">
                        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                        </a>
                        <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                                </button>
                            </div>
                            </div>
                        </form>
                        </div>
                    </li>
                    {{-- end Navbar Search --}}

                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fa-solid fa-expand"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                            <i class="fa-solid fa-table-cells-large"></i>
                        </a>
                    </li>

                </ul>
                {{-- end Right navbar links --}}

            </nav>
            {{-- end navbar --}}

             {{-- Main Sidebar Container --}}
        <aside class="main-sidebar  sidebar-light-desnaz">
            {{-- Brand Logo --}}
            <a href="{{ url('/') }}" class="brand-link">
                <img src="{{ asset('dist/img/icon_logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">siLaba ERP</span>
            </a>
            {{-- end Brand Logo --}}

            {{-- Sidebar --}}
            <div class="sidebar">


                {{-- SidebarSearch Form  --}}
                <div class="form-inline mt-3 pb-2 mb-0 d-flex">
                    <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                    </div>
                </div>
                {{-- end SidebarSearch Form  --}}

                {{-- Sidebar Menu  --}}
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link {{ ( request()->segment(1) == '' ) ? 'active' : '' }}">
                                <i class="nav-icon fa-solid fa-gauge"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/buku_induk_siswa') }}" class="nav-link {{ ( request()->segment(1) == 'buku_induk_siswa' ) ? 'active' : '' }}">
                                <i class="nav-icon fa-solid fa-book"></i>
                                <p>Kas & Bank</p>
                            </a>
                        </li>

                        <li class="nav-item {{ ( request()->segment(1) == 'sale' ) ? 'menu-is-opening menu-open' : '' }}">
                            <a href="#" class="nav-link {{ ( request()->segment(1) == 'sale' ) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cart-plus"></i>
                                <p>Penjualan <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('sales/bill_ofsale') }}" class="nav-link pl-1 {{ ( request()->segment(2) == 'bill_ofsale' ) ? 'active' : '' }}">
                                        <i class="fa-solid fa-cash-register nav-icon"></i>
                                    <p>Tagihan Penjualan</p>
                                </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('sales/sales_delivery') }}" class="nav-link pl-1 {{ ( request()->segment(2) == 'sales_delivery' ) ? 'active' : '' }}">
                                    <i class="fa-solid fa-truck nav-icon"></i>
                                    <p>Pengiriman Penjualan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('sales/sales_order') }}" class="nav-link pl-1 {{ ( request()->segment(2) == 'sales_order' ) ? 'active' : '' }}">
                                    <i class="fas fa-shopping-basket nav-icon"></i>
                                    <p>Pesanan Penjualan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('sale/purchase_offer') }}" class="nav-link pl-1 {{ ( request()->segment(2) == 'purchase_offer' ) ? 'active' : '' }}">
                                    <i class="fas fa-tags nav-icon"></i>
                                    <p>Penawaran Penjualan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                            {{-- <li class="nav-header">INVENTORY</li> --}}

                            <li class="nav-item {{ ( request()->segment(1) == 'purchase' ) ? 'menu-is-opening menu-open' : '' }}">
                                <a href="#" class="nav-link {{ ( request()->segment(1) == 'purchase' ) ? 'active' : '' }}">
                                    <i class="nav-icon fa-solid fa-bag-shopping"></i>
                                    <p>Pembelian <i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('purchase/purchase_invoice') }}" class="nav-link pl-1 {{ ( request()->segment(2) == 'purchase_invoice' ) ? 'active' : '' }}">
                                        <i class="fas fa-shopping-bag nav-icon"></i>
                                        <p>Tagihan Pembelian</p>
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('purchase/purchase_order') }}" class="nav-link pl-1 {{ ( request()->segment(2) == 'purchase_order' ) ? 'active' : '' }}">
                                        <i class="fas fa-shopping-basket nav-icon"></i>
                                        <p>Pesanan Pembelian</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('purchase/purchase_offer') }}" class="nav-link pl-1 {{ ( request()->segment(2) == 'purchase_offer' ) ? 'active' : '' }}">
                                        <i class="fas fa-tags nav-icon"></i>
                                        <p>Penawaran Pembelian</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('expenses') }}" class="nav-link {{ ( request()->segment(1) == 'expenses' ) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-donate"></i>
                                    <p>Biaya</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('contact') }}" class="nav-link {{ ( request()->segment(1) == 'contact' ) ? 'active' : '' }}">
                                    <i class="nav-icon fa-solid fa-address-card"></i>
                                    <p>Kontak</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('cost') }}" class="nav-link {{ ( request()->segment(1) == 'cost' ) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-donate"></i>
                                    <p>Aset tetap</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('item') }}" class="nav-link {{ ( request()->segment(1) == 'item' ) ? 'active' : '' }}">
                                    <i class="nav-icon fa-solid fa-box"></i>
                                    <p>Produk</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('setting') }}" class="nav-link {{ ( request()->segment(1) == 'setting' ) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>Pengaturan</p>
                                </a>
                            </li>

                            <li class="nav-header">LAPORAN</li>
                    </ul>
                </nav>
                {{-- end Sidebar Menu  --}}

            </div>
                    {{-- end Sidebar --}}

        </aside>
        {{-- end Main Sidebar Container --}}

        {{-- Content Wrapper. Contains page content --}}
        <div class="content-wrapper">

            <section class="content-header">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-sm-8">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                @yield('content')
            </section>

        </div>
        {{-- End Content Wrapper. Contains page content --}}


        {{-- main-footer --}}
        <footer class="main-footer">
            <strong>PT Glocal Jaya Raya</strong>
            <div class="float-right d-none d-sm-inline-block">
                Versi 4.01 | Framework Laravel V 10.0 | Template Admin Lte
            </div>
        </footer>
        {{-- end main-footer --}}

        @yield('Modal')

    </div>
    {{-- end wrapper --}}
    </body>

    {{-- REQUIRED SCRIPTS --}}
    {{-- jQuery --}}
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    {{-- Bootstrap --}}
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    {{-- Summernote --}}
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>

     {{-- Ekko Lightbox --}}
    <script src="{{ asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

    {{-- bs-custom-file-input --}}
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    {{-- InputMask --}}
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>

    {{-- date-range-picker --}}
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

    {{-- DatePicker  --}}
    <script src="{{ asset('plugins/datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    {{-- overlayScrollbars --}}
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    {{-- DATATABLE --}}
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


    {{-- Sweatalert --}}
   <script src="{{ asset('plugins/bootstrap-sweetalert/dist/sweetalert.min.js') }}"></script>

   {{-- jquery-validation --}}
   <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
   <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>

   {{-- Summernote --}}
   <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>

   {{-- TAGINPUT --}}
   <script src="{{ asset('plugins/Bootstrap-4-Tag-Input-Plugin-jQuery/tagsinput.js') }}"></script>

    {{-- notify --}}
   <script src="{{ asset('plugins/notify/notify.min.js') }}"></script>

    {{-- Images Loader --}}
   <script src="{{ asset('plugins/images-loader/jquery.imagesloader-1.0.1.js') }}"></script>

    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('dist/js/function.js') }}"></script>

    @yield('Notify')
    @yield('javascript')

</html>
