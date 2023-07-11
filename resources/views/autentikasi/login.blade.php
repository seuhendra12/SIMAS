@extends('layouts.auth')
@section('title', 'Halaman Login')
@section('container')
<div class="d-flex flex-column flex-root bg-secondary" id="kt_app_root">
	<div class="d-flex flex-column flex-lg-row flex-column-fluid">
		<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
			<div>
				<img alt="Logo" src="{!! asset('/img/logo/logo_sim.png') !!}" class="h-60px h-lg-75px" />
			</div>
			<div class="d-flex flex-center flex-column flex-lg-row-fluid">
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

							// Atur waktu penghilangan notifikasi setelah 3 detik
							setTimeout(function() {
								document.getElementById('notification').style.display = 'none';
							}, 5000);
						});
					</script>
					@endif
					@if(Session::has('success'))
					<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered  w-25">
							<div class="modal-content text-center">
								<div class="modal-body">
									<div class="mb-5">
										<img alt="Logo" src="{!! asset('/img/icon/success.png') !!}" class="h-60px h-lg-75px" />
										<H5 class="mt-1 fw-bold">SUKSES</H5>
									</div class="mb-2">
									{{ Session::get('success') }}
									<div>
										<button type="button" class="btn btn-primary mt-2" data-bs-dismiss="modal" aria-label="Close">
											OK
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<script>
						document.addEventListener('DOMContentLoaded', function() {
							var myModal = new bootstrap.Modal(document.getElementById('successModal'));
							myModal.show();
						});
					</script>
					@endif
					@if(session()->has('errorLogin'))
					<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered  w-25">
							<div class="modal-content text-center">
								<div class="modal-body">
									<div class="mb-5">
										<img alt="Logo" src="{!! asset('/img/icon/wrong.png') !!}" class="h-60px h-lg-75px" />
										<H5 class="mt-1 fw-bold">ERROR</H5>
									</div class="mb-2">
									{{ session('errorLogin') }}
									<div>
										<button type="button" class="btn btn-primary mt-2" data-bs-dismiss="modal" aria-label="Close">
											OK
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<script>
						document.addEventListener('DOMContentLoaded', function() {
							var myModal = new bootstrap.Modal(document.getElementById('errorModal'));
							myModal.show();
						});
					</script>
					@endif
					<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="{{ route('login') }}" method="POST">
						@csrf
						<div class="mb-3">
							<h1 class="text-dark fw-bolder mb-3">Masuk</h1>
							<div class="text-gray-500 fw-semibold fs-6">Masuk dengan surel dan kata sandimu</div>
						</div>
						<div class="fv-row mb-8">
							<label class="fw-bolder mb-1">Surel</label>
							<input type="email" placeholder="Email" name="email" autocomplete="off" class="form-control bg-white" value="{{ old('email') ?? session('email') }}" required />
						</div>
						<div class="fv-row mb-3">
							<div class="row">
								<div class="col-7">
									<label class="fw-bolder mb-1">Kata Sandi</label>
								</div>
							</div>
							<input type="password" placeholder="Kata sandi" name="password" autocomplete="off" class="form-password bg-white" required />
						</div>
						<div class="row">
							<div class="col-1 mt-1">
								<input type="checkbox" class="form-checkbox mb-4 d-inline">
							</div>
							<div class="col-5">
								<div class="text-gray-500 fw-semibold fs-6"> Tampilkan Kata Sandi</div>
							</div>
						</div>
						<div>
							<span>
								<p>Belum memiliki akun ? <a href="/registrasi">Daftar sekarang</a></p>
							</span>
						</div>
						<div class="d-grid col-3">
							<button type="submit" name="submit" id="kt_sign_in_submit" class="btn btn-primary">
								<span>Masuk</span>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url('<?php echo asset("img/background/background-login.png"); ?>')"></div>
		@endsection