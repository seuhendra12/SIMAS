		<!-- HEADER & NAVBAR -->
		<div id="kt_app_header" class="app-header">
			<div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
				<div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
					<div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
						<span class="svg-icon svg-icon-2 svg-icon-md-1">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
								<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
							</svg>
						</span>
					</div>
				</div>
				<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
					<a href="/" class="d-lg-none">
						<img alt="Logo" src="{!! asset('/img/logo/logo_sim_min.png') !!}" class="h-30px" />
					</a>
				</div>
				<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
					<div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
					</div>
					<div class="app-navbar flex-shrink-0">
						<div class="app-navbar-item ms-1 ms-md-3" id="kt_header_user_menu_toggle">
							<div class="me-5">
								<a href="{{url('notif')}}" class="notification-icon">
									<svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
										<path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z" />
									</svg>
									<span class="badge badge-sm badge-danger">{{ $inactiveUserCount }}</span>
								</a>
							</div>
							<div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
								<img src="{!! asset('/img/icon/icon_user.jpg') !!}" alt="user" />
								<span class="fw-bold me-3">{{Auth::user()->name}}</span>
							</div>
							<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
								<div class="menu-item px-3">
									<div class="menu-content d-flex align-items-center px-3">
										<div class="symbol symbol-50px me-5">
											<img alt="Logo" src="{!! asset('/img/icon/icon_user.jpg') !!}" />
											{{Auth::user()->name}}
										</div>
										<div class="d-flex flex-column">
											<div class="fw-bold d-flex align-items-center fs-5">
											</div>
											<a href="#" class="fw-semibold text-muted text-hover-primary fs-7"></a>
										</div>
									</div>
								</div>
								<div class="separator my-2"></div>
								<div class="menu-item px-5">
									<a href="#" class="menu-link px-5" data-bs-toggle="modal" data-bs-target="#profil"><i class="fas fa-eye me-2"></i>Profilku</a>
								</div>
								<div class="menu-item px-5">
									<a href="{{url('/')}}" class="menu-link px-5"><i class="fas fa-home me-2"></i>Kunjungi Halaman Depan</a>
								</div>
								<div class="menu-item px-5">
									<form action="/logout" method="POST">
										@csrf
										<button class="btn border-0 menu-link px-5" type="submit" onclick="return confirm('Apakah yakin ingin keluar ?')"><i class="fas fa-power-off me-2"></i>Keluar</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="profil" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered mw-600px">
				<div class="modal-content">
					<div class="modal-header text-center">
						<h2>Profil Pengguna</h2>
						<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
							<span class="svg-icon svg-icon-1">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
								</svg>
							</span>
						</div>
					</div>
					<div class="modal-body py-lg-10 px-lg-10">
						<div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid" id="profil">
							<div class="d-flex justify-content-center justify-content-xl-start flex-row-auto w-100 w-xl-300px">
								<div class="stepper-nav ps-lg-10">
									<div class="stepper-item current" data-kt-stepper-element="nav">
										<div class="stepper-wrapper">
											<div class="stepper-label">
												<h3 class="stepper-title">NIK</h3>
												<div class="stepper-desc">{{Auth::user()->nik}}</div>
											</div>
										</div>
										<div class="stepper-wrapper mt-5">
											<div class="stepper-label">
												<h3 class="stepper-title">Nama Lengkap</h3>
												<div class="stepper-desc">{{Auth::user()->name}}</div>
											</div>
										</div>
										<div class="stepper-wrapper mt-5">
											<div class="stepper-label">
												<h3 class="stepper-title">Role</h3>
												<div class="stepper-desc">{{Auth::user()->role}}</div>
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