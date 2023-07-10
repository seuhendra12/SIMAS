@extends('layouts.auth')
@section('title','Halaman Registrasi')
@section('container')
<div class="d-flex flex-column flex-root bg-secondary" id="kt_app_root">
	<div class="d-flex flex-column flex-lg-row flex-column-fluid">
		<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
			<div>
				<img alt="Logo" src="{!! asset('/img/logo/logo_sim.png') !!}" class="h-60px h-lg-75px" />
			</div>
			<div class="d-flex flex-center flex-column flex-lg-row-fluid">
				<div class="w-lg-500px p-10 bg-white rounded-3">
					@if($errors->any())
					@foreach($errors->all() as $err)
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<i class="fa fa-exclamation-triangle"></i> {{ $err }}
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
					</div>
					@endforeach
					@endif
					@if(session()->has('errorLogin'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<i class="fa fa-exclamation-triangle"></i> {{session('errorLogin')}}
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
					</div>
					@endif
					<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="/sesi-login" method="POST">
						@csrf
						<div class="mb-3">
							<h1 class="text-dark fw-bolder">Registrasi Akun</h1>
							<div class="text-gray-500 fw-semibold fs-6">Daftarkan akun berdasarkan data diri Anda</div>
						</div>
						<div class="fv-row">
							<label class="fw-bolder mb-1">Nama Lengkap</label>
							<input type="text" placeholder="Nama Lengkap" name="nama_lengkap" autocomplete="off" class="form-control bg-white" value="{{ old('nama_lengkap') ?? session('nama_lengkap') }}" required />
						</div>
						<div class="fv-row">
							<label class="fw-bolder mb-1">Username</label>
							<input type="text" placeholder="Username" name="username" autocomplete="off" class="form-control bg-white" value="{{ old('username') ?? session('username') }}" required />
						</div>
						<div class="fv-row">
							<label class="fw-bolder mb-1">Email</label>
							<input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-white" value="{{ old('email') ?? session('email') }}" required />
						</div>
						<div class="fv-row">
							<div class="row">
								<div class="col-7">
									<label class="fw-bolder mb-1">Kata Sandi</label>
								</div>
							</div>
							<input type="password" placeholder="Password" name="password" autocomplete="off" class="form-password bg-white" required />
						</div>
						<div class="row">
							<div class="col-1 mt-1">
								<input type="checkbox" class="form-checkbox mb-4 d-inline">
							</div>
							<div class="col-5">
								<div class="text-gray-500 fw-semibold fs-6"> Tampilkan Kata Sandi</div>
							</div>
						</div>
						<span>
							<p>Sudah memiliki akun ? <a href="/login">Login sekarang</a></p>
						</span>
						<div class="d-grid col-3">
							<button type="submit" name="submit" id="kt_sign_in_submit" class="btn btn-primary">
								<span>Daftar</span>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url('<?php echo asset("img/background/background-login.png"); ?>')"></div>
	</div>
	@endsection