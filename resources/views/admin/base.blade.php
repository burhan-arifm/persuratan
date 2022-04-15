@extends('layouts.app')

@section('page-title')
@yield('title') | SIMDAK-FIDKOM UIN Sunan Gunung Djati Bandung
@endsection

@section("additional-css")
@endsection

@section('body')
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('beranda') }}">
            <div class="sidebar-brand-icon w-25">
                <img class="img-thumbnail bg-transparent border-0" src="{{ asset('storage/uin-bandung-logo.png') }}"
                    alt="Logo UIN Sunan Gunung Djati Bandung">
            </div>
            <div class="mx-3">
                <span class="d-block">SIMDAK</span>
                <span class="d-block">FIDKOM</span>
            </div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item{{ Request::routeIs('beranda') ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('beranda') }}">
                <i class="ph-house-fill align-middle"></i>
                <span>Beranda</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Tables -->
        <li class="nav-item{{ Request::routeIs('surat.riwayat') ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('surat.riwayat') }}">
                <i class="ph-table-fill align-middle"></i>
                <span>Persuratan</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item{{ Request::routeIs('pengaturan.surat.buka') ? ' active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="ph-wrench-fill align-middle"></i>
                <span>Pengaturan Surat</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @foreach($tipe_surat as $surat)
                    <a href="{{ route('pengaturan.surat.buka', ['kode_surat' => $surat->kode_surat]) }}"
                        class="collapse-item">{{ $surat->jenis_surat }}</a>
                    @endforeach
                </div>
            </div>
        </li>

        @if (Auth::user()->is_admin)
        <li
            class="nav-item{{ Request::routeIs('pengaturan.admin') || Request::routeIs('pengaturan.admin.formTambah') ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('pengaturan.admin.index') }}">
                <i class="ph-user-fill align-middle"></i>
                <span>Pengaturan Akun Admin</span></a>
        </li>
        @endif

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="ph-list-fill align-middle"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                            <img class="img-profile rounded-circle" src="{{ asset('storage/undraw_profile.svg') }}">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('pengaturan.akun.buka') }}">
                                <i class="ph-gear-six-fill align-middle mr-2 text-gray-400"></i>
                                Pengaturan Akun
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" id="logout">
                                <i class="ph-sign-out-fill align-middle mr-2 text-gray-400"></i>
                                Keluar
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div id="app" class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800 font-weight-bold">@yield('title')</h1>

                @yield('main')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; SIMDAK-FIDKOM {{ now()->year }}</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="ph-caret-up-fill"></i>
</a>
@endsection

@section('additional-scripts')
<script type="text/javascript" src="{{ asset('js/vendor.admin.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>
@yield('scripts')
@if ($message = session('message'))
<script>
    @if (array_key_exists('modal', $message) && $message['modal'] == true)
    modal.fire({
        icon: '{{ $message['icon'] }}',
        title: '{{ $message['title'] }}',
        html: '{!! $message['text'] !!}',
        showCloseButton: true,
        buttonsStyling: false,
        customClass: {
            confirmButton: "btn btn-danger m-1"
        },
    });
    @else
    toast.fire({
        title: '{{ $message['title'] }}',
        icon: '{{ $message['icon'] }}'
    });
    @endif
</script>
@endif
@endsection