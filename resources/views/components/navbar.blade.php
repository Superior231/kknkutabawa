<nav class="py-0 my-0 shadow-sm navbar sticky-top bg-light">
    <div class="container py-0 my-0">
        <a class="gap-2 navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ url('assets/img/logo.png') }}" alt="Logo" class="logo" style="width: 40px;">
            <div class="gap-0 d-flex flex-column justify-content-center align-items-start">
                <span class="py-0 my-0 text-color"><b>KKN DESA KUTABAWA<sup>2025</sup></b></span>
                <span class="py-0 my-0 text-color">Universitas Pancasakti Tegal</span>
            </div>
        </a>
        <ul class="links" id="navbarNav1">
            <li>
                <a class="px-0 nav-link" href="{{ request()->url() === url('/') ? '#home' : route('home') . '#home' }}">Home</a>
            </li>
            <li>
                <a class="px-0 nav-link" href="{{ request()->url() === url('/') ? '#profil-desa' : route('home') . '#profil-desa' }}">Profil Desa</a>
            </li>
            <li>
                <a class="px-0 nav-link" href="{{ request()->url() === url('/') ? '#struktur-organisasi-kkn' : route('home') . '#struktur-organisasi-kkn' }}">Struktur Organisasi KKN</a>
            </li>
            <li>
                <a class="px-0 nav-link" href="{{ request()->url() === url('/') ? '#projects' : route('home') . '#projects' }}">Projects</a>
            </li>
        </ul>
        <!-- hamburger menu -->
        <div class="toggle_btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <i class="fa-solid fa-bars-staggered color-text"></i>
        </div>

        <!-- canvas menu for mobile -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <div class="gap-2 offcanvas-title d-flex align-items-center">
                    <img src="{{ url('assets/img/logo.png') }}" alt="Logo" class="logo" style="width: 40px;">
                    <div class="gap-0 d-flex flex-column justify-content-center align-items-start">
                        <h5 class="my-0 fw-bold" id="offcanvasNavbarLabel">KKN DESA KUTABAWA <sup>2025</sup></h5>
                        <span class="my-0 text-color">Universitas Pancasakti Tegal</span>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="pt-0 mt-0 offcanvas-body">
                <ul class="d-flex flex-column align-items-start justify-content-start">
                    <li>
                        <a class="px-0 py-0 nav-link" href="{{ request()->url() === url('/') ? '#home' : route('home') . '#home' }}">Home</a>
                    </li>
                    <li>
                        <a class="px-0 py-0 nav-link" href="{{ request()->url() === url('/') ? '#profil-desa' : route('home') . '#profil-desa' }}">Profil Desa</a>
                    </li>
                    <li>
                        <a class="px-0 py-0 nav-link" href="{{ request()->url() === url('/') ? '#struktur-organisasi-kkn' : route('home') . '#struktur-organisasi-kkn' }}">Struktur Organisasi KKN</a>
                        </li>
                    <li>
                        <a class="px-0 py-0 nav-link" href="{{ request()->url() === url('/') ? '#projects' : route('home') . '#projects' }}">Projects</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let scrollSpy1 = new bootstrap.ScrollSpy(document.body, {
            target: "#navbarNav1",
        });
    });
</script>
