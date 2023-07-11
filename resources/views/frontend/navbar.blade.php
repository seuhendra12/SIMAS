<nav class="navbar navbar-expand-md bg-green fixed-top">
  <div class="container-fluid">
    <div class="ms-3">
      <img src="{!! asset('/img/logo/logo_sim.png') !!}" alt="user" class="logo" />
    </div>
    <!-- Button responsive -->
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse offcanvas offcanvas-end" data-bs-scroll="true" id="offcanvasWithBothOptions" tabindex="-1" id="navbarNav">
      <div class="offcanvas-header w-100 align-items-center">
        <h2 class="mb-0">SIMAS</h2>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <ul class="navbar-nav ms-auto mx-3 pt-2">
        <li class="nav-item py-2 me-3">
          <a class="nav-link text-white fw-bold" aria-current="page" href="/">Beranda</a>
        </li>
        <li class="nav-item py-2 me-3">
          <a class="nav-link text-white fw-bold" href="#regulasi_peraturan">Regulasi Peraturan</a>
        </li>
        <li class="nav-item py-2 me-3">
          <a class="nav-link text-white fw-bold" href="#statistik">Statistik</a>
        </li>
        <li class="nav-item py-2 me-3">
          <a class="nav-link text-white fw-bold" href="#berita">Berita</a>
        </li>
        <li class="nav-item py-2">
          <a class="nav-link text-white fw-bold" href="#kontak">Kontak</a>
        </li>
        @if (Auth::check())
        <div class="dropdown pt-2 mt-1 ms-3">
          <div class="d-flex align-items-center" role="button" id="dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{!! asset('/img/icon/icon_user.jpg') !!}" alt="User Image" class="rounded-circle me-2" style="width: 30px; height: 30px;">
            <span class="text-white fw-bold">{{ Auth::user()->name }}</span>
          </div>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Profil</a></li>
            <li>
              <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="dropdown-item" onclick="return confirmLogout()">Logout</button>
              </form>
            </li>
          </ul>
        </div>
        @else
        <li class="nav-item">
          <div class="mb-2 text-white"></div>
          <div class="nav-link d-inline ms-3">
            <a href="/login" class="btn btn-light mb-3 rounded-0 fw-bold">Login</a>
          </div>
        </li>
        <li class="nav-item">
          <div class="mb-2 text-white"></div>
          <div class="nav-link d-inline">
            <a href="/registrasi" class="btn btn-success mb-3 rounded-0 fw-bold">Registrasi</a>
          </div>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
<script>
function confirmLogout() {
    return confirm('Yakin ingin keluar?');
}
</script>
