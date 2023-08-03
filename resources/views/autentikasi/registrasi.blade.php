@extends('layouts.auth')
@section('title', 'Halaman Registrasi')
@section('container')
<div class="d-flex flex-column flex-root" id="kt_app_root">
	<div class="d-flex flex-column flex-lg-row flex-column-fluid">
		<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
			<!-- <div class="mx-auto text-center">
				<img alt="Logo" src="{!! asset('/img/logo/logo_sim.png') !!}" class="h-60px h-lg-75px" />
			</div> -->
			<div class="mx-auto my-auto">
				<div class="card-login">
					<div class="w-lg-500px p-10 bg-white rounded-3">
						<!-- NOTIFIKASI ERROR -->
						@if ($errors->any())
						<div id="notification" class="alert alert-danger" style="display: none;">
							<ul>
								@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
						<script>
							// Tampilkan notifikasi saat halaman dimuat
							document.addEventListener('DOMContentLoaded', function() {
								document.getElementById('notification').style.display = 'block';

								// Atur waktu penghilangan notifikasi setelah 5 detik
								setTimeout(function() {
									document.getElementById('notification').style.display = 'none';
								}, 5000);
							});
						</script>
						@endif
						<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="{{url('registrasi')}}" method="POST">
							@csrf
							<div class="mb-3 text-center">
								<h1 class="text-dark fw-bolder">Registrasi Akun</h1>
								<div class="text-gray-500 fw-semibold fs-6">Daftarkan akun berdasarkan data diri Anda</div>
							</div>
							<div class="fv-row">
								<label class="fw-bolder mb-1">NIK</label>
								<input type="text" placeholder="Masukkan NIK Kepala Keluarga" name="nik" autocomplete="off" class="form-control bg-white" value="{{ old('nik') ?? session('nik') }}" required />
							</div>
							<div class="fv-row mt-2">
								<label class="fw-bolder mb-1">Nama Lengkap</label>
								<input type="text" placeholder="Masukkan Nama Lengkap" name="name" autocomplete="off" class="form-control bg-white" value="{{ old('name') ?? session('name') }}" required />
							</div>
							<div class="fv-row mt-2">
								<label class="fw-bolder mb-1">Email</label>
								<input type="text" placeholder="Masukkan Email" name="email" autocomplete="off" class="form-control bg-white" value="{{ old('email') ?? session('email') }}" required />
							</div>
							<div class="fv-row mt-2 mb-4">
								<div class="row">
									<div class="col-7">
										<label class="fw-bolder mb-1">Kata Sandi</label>
									</div>
								</div>
								<input type="password" placeholder="Masukkan Kata Sandi" name="password" autocomplete="off" class="form-password bg-white" required />
							</div>
							<div class="row">
								<div class="col-1 mt-1">
									<input type="checkbox" class="form-checkbox mb-4 d-inline">
								</div>
								<div class="col-11">
									<div class="text-gray-500 fw-semibold fs-6"> Tampilkan Kata Sandi</div>
								</div>
							</div>
							<span>
								<p>Sudah memiliki akun ? <a href="/login">Login sekarang</a></p>
							</span>
							<div class="d-grid col-3">
								<button type="submit" name="submit" class="btn btn-primary btn-sm rounded-0">
									<span>Daftar</span>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection