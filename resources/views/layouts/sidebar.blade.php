<!-- SIDEBAR -->
<div id="kt_app_sidebar" class="app-sidebar flex-column element-above" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
	<div class="app-sidebar-logo  " id="kt_app_sidebar_logo">
		<a href="#">
			<img alt="Logo" src="{!! asset('/img/logo/logo_sim.png') !!}" class="h-50px app-sidebar-logo-default" />
			<img alt="Logo" src="{!! asset('/img/logo/logo_sim_min.png') !!}" class="h-40px app-sidebar-logo-minimize" />
		</a>
		<div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
			<span class="svg-icon svg-icon-2 rotate-180">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="currentColor" />
					<path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="currentColor" />
				</svg>
			</span>
		</div>
	</div>
	<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
		<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
			<div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
				<a href="/dashboard" class="menu-item active">
					<span class="menu-link">
						<span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layers-fill" viewBox="0 0 16 16">
									<path d="M7.765 1.559a.5.5 0 0 1 .47 0l7.5 4a.5.5 0 0 1 0 .882l-7.5 4a.5.5 0 0 1-.47 0l-7.5-4a.5.5 0 0 1 0-.882l7.5-4z" />
									<path d="m2.125 8.567-1.86.992a.5.5 0 0 0 0 .882l7.5 4a.5.5 0 0 0 .47 0l7.5-4a.5.5 0 0 0 0-.882l-1.86-.992-5.17 2.756a1.5 1.5 0 0 1-1.41 0l-5.17-2.756z" />
								</svg>
							</span>
						</span>
						<span class="menu-title {{ Route::currentRouteName() === 'dashboard' ? 'text-white' : '' }}">Dasbor</span>
					</span>
				</a>
				@if(Auth::user()->role === 'Pengelola')
				<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
					<span class="menu-link">
						<span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
									<path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
									<path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
								</svg>
							</span>
						</span>
						<span class="menu-title ">Referensi</span>
						<span class="menu-arrow"></span>
					</span>
					<div class="menu-sub menu-sub-accordion">
						<div class="menu-item">
							<a class="menu-link" href="{{url('data-rt')}}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title {{ Request::is('data-rt')?'text-white' : '' }}">Data RT</span>
							</a>
							<a class="menu-link" href="{{url('data-rw')}}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title {{ Request::is('data-rw')?'text-white' : '' }}">Data RW</span>
							</a>
							<a class="menu-link" href="{{url('kategori-sampah')}}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title {{ Request::is('kategori-sampah')?'text-white' : '' }}">Kategori Sampah</span>
							</a>
						</div>
					</div>
				</div>
				<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
					<span class="menu-link">
						<span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
									<path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
									<path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
								</svg>
							</span>
						</span>
						<span class="menu-title ">Manajemen Pengguna</span>
						<span class="menu-arrow"></span>
					</span>
					<div class="menu-sub menu-sub-accordion">
						<div class="menu-item">
							<a class="menu-link" href="{{url('data-pengguna')}}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title {{ Request::is('data-pengguna')?'text-white' : '' }}">Pengguna</span>
							</a>
							<a class="menu-link" href="{{url('data-role')}}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title {{ Request::is('data-role')?'text-white' : '' }}">Role</span>
							</a>
						</div>
					</div>
				</div>
				<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
					<span class="menu-link">
						<span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
									<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
									<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
								</svg>
							</span>
						</span>
						<span class="menu-title ">Manajemen Sampah</span>
						<span class="menu-arrow"></span>
					</span>
					<div class="menu-sub menu-sub-accordion">
						<div class="menu-item">
							<a class="menu-link" href="{{url('jenis-sampah')}}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title {{ Request::is('jenis-sampah')?'text-white' : '' }}">Jenis Sampah</span>
							</a>
							<a class="menu-link" href="{{url('sampah-dikumpulkan')}}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title {{ Request::is('sampah-dikumpulkan')?'text-white' : '' }}">Sampah Dikumpulkan</span>
							</a>
							<a class="menu-link" href="{{url('sampah-dimanfaatkan')}}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title {{ Request::is('sampah-dimanfaatkan')?'text-white' : '' }}">Sampah Dimanfaatkan</span>
							</a>
							<a class="menu-link" href="{{url('sampah-diolah-internal')}}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title {{ Request::is('sampah-diolah-internal')?'text-white' : '' }}">Sampah Diolah Internal</span>
							</a>
							<a class="menu-link" href="#">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title ">Sampah Diolah Eksternal</span>
							</a>
							<a class="menu-link" href="#">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title ">Sampah Dibuang TPA</span>
							</a>
						</div>
					</div>
				</div>
				<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
					<span class="menu-link">
						<span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-coin" viewBox="0 0 16 16">
									<path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z" />
									<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
									<path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
								</svg>
							</span>
						</span>
						<span class="menu-title ">Manajemen Transaksi</span>
						<span class="menu-arrow"></span>
					</span>
					<div class="menu-sub menu-sub-accordion">
						<div class="menu-item">
							<a class="menu-link" href="{{url('transaksi-sampah')}}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title {{ Request::is('transaksi-sampah')?'text-white' : '' }}">Transaksi Sampah</span>
							</a>
							<a class="menu-link" href="{{url('konversi-poin')}}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title {{ Request::is('konversi-poin')?'text-white' : '' }}">Konversi Poin Sampah</span>
							</a>
							<a class="menu-link" href="{{url('tukar-poin-admin')}}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title {{ Request::is('tukar-poin-admin')?'text-white' : '' }}">Tukar Poin Sampah</span>
							</a>
						</div>
					</div>
				</div>
				<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
					<span class="menu-link">
						<span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
									<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
									<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
									<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
								</svg>
							</span>
						</span>
						<span class="menu-title ">Manajemen Berita</span>
						<span class="menu-arrow"></span>
					</span>
					<div class="menu-sub menu-sub-accordion">
						<div class="menu-item">
							<a class="menu-link" href="#">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Tag</span>
							</a>
							<a class="menu-link" href="{{url('kategoris')}}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Kategori</span>
							</a>
							<a class="menu-link" href="{{url('unitKerja')}}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Unit Kerja</span>
							</a>
						</div>
					</div>
				</div>
				@endif
				<!-- Halaman khusus admin dan kelurahan -->
				@if(Auth::user()->role === 'Pengelola' || Auth::user()->role === 'Kelurahan')
				<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
					<span class="menu-link">
						<span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark" viewBox="0 0 16 16">
									<path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
								</svg>
							</span>
						</span>
						<span class="menu-title ">Laporan</span>
						<span class="menu-arrow"></span>
					</span>
					<div class="menu-sub menu-sub-accordion">
						<div class="menu-item">
							<a class="menu-link" href="{{url('laporan-sampah-dikumpulkan')}}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title {{ Request::is('laporan-sampah-dikumpulkan')?'text-white' : '' }}">Sampah Dikumpulkan</span>
							</a>
							<a class="menu-link" href="#">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title ">Sampah Dimanfaatkan</span>
							</a>
							<a class="menu-link" href="#">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title ">Sampah Diolah Internal</span>
							</a>
							<a class="menu-link" href="#">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title ">Sampah Diolah Eksternal</span>
							</a>
							<a class="menu-link" href="#">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title ">Sampah Dibuang TPA</span>
							</a>
						</div>
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>