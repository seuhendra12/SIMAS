@extends('layouts.index')
@section('title','Halaman Dashboard Admin')
@section('container')

<!-- MAIN CONTENT -->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
	<div class="d-flex flex-column flex-column-fluid">
		<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
			<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
				<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
					<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Dashboard Admin</h1>
					<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7">
						<li class="breadcrumb-item text-muted">
							<a href="#" class="text-muted text-hover-primary">Home</a>
						</li>
						<li class="breadcrumb-item">
							<span class="bullet bg-gray-400 w-5px h-2px"></span>
						</li>
						<li class="breadcrumb-item text-muted">Dashboards</li>
					</ul>
				</div>
			</div>
		</div>
		<div id="kt_app_content" class="app-content flex-column-fluid">
			<div id="kt_app_content_container" class="app-container container-fluid">
				<div class="row g-5 g-xl-10 mb-5 mb-xl-10">
					<div class="col-xxl-6">
						<div class="card card-flush h-md-100">
							<div class="card-body d-flex flex-column justify-content-between bgi-no-repeat bgi-size-cover bgi-position-x-center pb-0">
								<div class="mb-10">
									<div class="fs-2hx fw-bold text-gray-800 text-center mb-13">
										<div class="row">
											<div class="col-3">
												<div class="card card-flush" style="background-color: #F1416C">
													<div class="card-header pt-5">
														<div class="card-title d-flex flex-column">
															<span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{$jenis_sampah->count()}}</span>
															<span class="text-white opacity-75 pb-10 fw-semibold fs-6">Jenis Sampah</span>
														</div>
													</div>
												</div>
											</div>
											<div class="col-3">
												<div class="card card-flush" style="background-color: #00CED1">
													<div class="card-header pt-5">
														<div class="card-title d-flex flex-column">
															<span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{$transaksi_sampah->sum('total_berat')}} Kg</span>
															<span class="text-white opacity-75 pb-10 fw-semibold fs-6">Sampah Dikumpulkan</span>
														</div>
													</div>
												</div>
											</div>
											<div class="col-3">
												<div class="card card-flush" style="background-color: #90EE90">
													<div class="card-header pt-5">
														<div class="card-title d-flex flex-column">
															<span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">0</span>
															<span class="text-white opacity-75 pb-10 fw-semibold fs-6">Sampah Dimanfaatkan</span>
														</div>
													</div>
												</div>
											</div>
											<div class="col-3">
												<div class="card card-flush" style="background-color:	#FFD700">
													<div class="card-header pt-5">
														<div class="card-title d-flex flex-column">
															<span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">0</span>
															<span class="text-white opacity-75 pb-10 fw-semibold fs-6">Sampah Diolah Internal</span>
														</div>
													</div>
												</div>
											</div>
											<div class="col-3">
												<div class="card card-flush mt-4" style="background-color:	#B37EFF">
													<div class="card-header pt-5">
														<div class="card-title d-flex flex-column">
															<span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">0</span>
															<span class="text-white opacity-75 pb-10 fw-semibold fs-6">Sampah Diolah Eksternal</span>
														</div>
													</div>
												</div>
											</div>
											<div class="col-3">
												<div class="card card-flush mt-4" style="background-color:	#FFA57E">
													<div class="card-header pt-5">
														<div class="card-title d-flex flex-column">
															<span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">0</span>
															<span class="text-white opacity-75 pb-10 fw-semibold fs-6">Sampah Dibuang TPA</span>
															</div>
														</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection