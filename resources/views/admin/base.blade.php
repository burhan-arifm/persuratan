@extends('layouts.app')

@section('page-title', "@yield('page-title')")

@section('content')
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
			<div class="profile-usertitle">
				<div class="profile-usertitle-status">Halo,</div>
				<div class="profile-usertitle-name">{{ Auth::user()->name }}</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
            <li>
                <a href="{{ route('beranda') }}">
                    <div class="row">
                        <div class="container">
                            <em class="fas fa-home">&nbsp;</em> Beranda
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('surat.riwayat') }}">
                    <div class="row">
                        <div class="container">
                            <em class="fas fa-table">&nbsp;</em> Daftar Surat
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('pengaturan.umum') }}">
                    <div class="row">
                        <div class="container">
                            <em class="fas fa-cog">&nbsp;</em> Pengaturan
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}" onclick="logout()">
                    <div class="row">
                        <div class="container">
                            <em class="fas fa-power-off">&nbsp;</em> Keluar
                        </div>
                    </div>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">@csrf</form>
            </li>
        </ul>
    </div>
    <div id="app" class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        @yield('main')
    </div>
@endsection