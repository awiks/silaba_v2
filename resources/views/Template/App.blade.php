<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
         {{-- Font Awesome Icons --}}
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
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
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                            <i class="fas fa-th-large"></i>
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
                <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">System POS</span>
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
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/buku_induk_siswa') }}" class="nav-link {{ ( request()->segment(1) == 'buku_induk_siswa' ) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Kas & Bank</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/buku_induk_siswa') }}" class="nav-link {{ ( request()->segment(1) == 'buku_induk_siswa' ) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Penjualan</p>
                            </a>
                        </li>


                            {{-- <li class="nav-header">INVENTORY</li> --}}

                            <li class="nav-item">
                                <a href="{{ url('purchase') }}" class="nav-link {{ ( request()->segment(1) == 'purchase' ) ? 'active' : '' }}">
                                    <i class="nav-icon far fa-credit-card"></i>
                                    <p>Pembelian</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('expenses') }}" class="nav-link {{ ( request()->segment(1) == 'expenses' ) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-donate"></i>
                                    <p>Biaya</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('contact') }}" class="nav-link {{ ( request()->segment(1) == 'contact' ) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-address-card"></i>
                                    <p>Kontak</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('cost') }}" class="nav-link {{ ( request()->segment(1) == 'cost' ) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-donate"></i>
                                    <p>Stok Produk</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('cost') }}" class="nav-link {{ ( request()->segment(1) == 'cost' ) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-donate"></i>
                                    <p>Aset tetap</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('customer') }}" class="nav-link {{ ( request()->segment(1) == 'customer' ) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-tag"></i>
                                    <p>Pelanggan</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('item') }}" class="nav-link {{ ( request()->segment(1) == 'item' ) ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-archive"></i>
                                    <p>Produk</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('supplier') }}" class="nav-link {{ ( request()->segment(1) == 'supplier' ) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-dolly nav-icon"></i>
                                    <p>Supplier</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('employee') }}" class="nav-link {{ ( request()->segment(1) == 'employee' ) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Pegawai</p>
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
            <strong>Kasnawi Point Of Sale</strong>
            <div class="float-right d-none d-sm-inline-block">
                Versi 4.01 | Framework Laravel V 10.0 | Template Admin Lte
            </div>
        </footer>
        {{-- end main-footer --}}

        @yield('modal')

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

    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('dist/js/function.js') }}"></script>

    @yield('Notify')
    @yield('javascript')

</html>
