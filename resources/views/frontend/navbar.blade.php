<nav class="navbar navbar-expand-md navbar-light bg-green fixed-top">
  <div class="container">
    <img src="{!! asset('/img/logo/logo_sim.png') !!}" alt="user" class="logo"/>
    <!-- Button responsive -->
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse offcanvas offcanvas-end" data-bs-scroll="true" id="offcanvasWithBothOptions" tabindex="-1" id="navbarNav">
      <div class="offcanvas-header w-100 align-items-center">
        <h2 class="mb-0">BCR</h2>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <ul class="navbar-nav ms-auto mx-3">
        <li class="nav-item">
          <div class="mb-2"></div>
          <a class="nav-link text-white fw-bold" aria-current="page" href="#sewa">Beranda</a>
        </li>
        <li class="nav-item">
          <div class="mb-2"></div>
          <a class="nav-link text-white fw-bold" href="#regulasi_peraturan">Regulasi Peraturan</a>
        </li>
        <li class="nav-item">
          <div class="mb-2"></div>
          <a class="nav-link text-white fw-bold" href="#testimonial">Statistik</a>
        </li>
        <li class="nav-item">
          <div class="mb-2"></div>
          <a class="nav-link text-white fw-bold" href="#faq">Berita</a>
        </li>
        <li class="nav-item">
          <div class="mb-2"></div>
          <a class="nav-link text-white fw-bold" href="#faq">Kontak</a>
        </li>
        <li class="nav-item">
          <div class="mb-2 text-white"></div>
          <div class="nav-link d-inline mb-5 ms-3">
            <a href="/login" class="btn btn-light mb-3 rounded-3 fw-bold">Login</a>
          </div>
        </li>
        <li class="nav-item">
          <div class="mb-2 text-white"></div>
          <div class="nav-link d-inline mb-5">
            <a href="/registrasi" class="btn btn-success mb-3 rounded-3 fw-bold">Registrasi</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>