@php
    use App\Models\Content;
    $content = Content::first();
@endphp

<footer class="pt-5 mt-5">
    <div class="container">
        <div class="row row-cols-1 row-cols-lg-2 d-flex justify-content-between">
            <div class="gap-3 mb-4 col col-lg-5 d-flex align-items-start flex-column">
                <a href="{{ route('home') }}" class="gap-2 logo d-flex align-items-center">
                    <img src="{{ url('assets/img/logo.png') }}" alt="logo" width="50px">
                    <div class="gap-0 d-flex flex-column justify-content-center align-items-start">
                        <h5 class="py-0 my-0 text-color fw-bold"><b>KKN DESA KUTABAWA<sup>2025</sup></b></h5>
                        <span class="py-0 my-0 text-color fs-7">Universitas Pancasakti Tegal</span>
                    </div>
                </a>
                <p>
                    {{ $content->hero_description }}
                </p>
            </div>
            <div class="col col-lg-7">
                <div class="row">
                    <div class="gap-3 mb-4 col col-6 col-md-4 d-flex align-items-start flex-column">
                        <p class="py-0 my-0 fw-bold footer-nav-title">Navigasi</p>
                        <div class="gap-2 link d-flex flex-column">
                            <a href="{{ route('home') }}">Beranda</a>
                            <a href="{{ request()->url() === url('/') ? '#profil-desa' : route('home') . '#profil-desa' }}">Profil Desa</a>
                            <a href="{{ request()->url() === url('/') ? '#struktur-organisasi-kkn' : route('home') . '#struktur-organisasi-kkn' }}">Struktur Organisasi KKN</a>
                            <a href="{{ request()->url() === url('/') ? '#projects' : route('home') . '#projects' }}">Projects</a>
                            @auth
                                <a href="{{ route('dashboard.index') }}">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}">Masuk</a>
                            @endauth
                        </div>
                    </div>
                    <div class="gap-3 mb-4 col col-6 col-md-3 d-flex align-items-start flex-column">
                        <p class="py-0 my-0 fw-bold footer-nav-title">Ikuti Kami</p>
                        <div class="gap-2 link d-flex flex-column">
                            <a href="https://www.youtube.com/@kkn.desakutabawa" class="gap-1 d-flex align-items-center" target="_blank">
                                <i class='bx bxl-youtube'></i> YouTube
                            </a>
                            <a href="https://www.instagram.com/kkn.desakutabawa/" class="gap-1 d-flex align-items-center" target="_blank">
                                <i class='bx bxl-instagram-alt'></i> Instagram
                            </a>
                            <a href="https://www.tiktok.com/@kkn.desakutabawa" class="gap-1 d-flex align-items-center" target="_blank">
                                <i class='bx bxl-tiktok'></i> TikTok
                            </a>
                        </div>
                    </div>
                    <div class="gap-3 mb-4 col col-12 col-md-5 d-flex align-items-start flex-column">
                        <p class="py-0 my-0 fw-bold footer-nav-title">Kontak</p>
                        <div class="gap-2 link d-flex flex-column">
                            <a href="mailto:contact@kknkutabawa.site" class="gap-1 d-flex align-items-center">
                                <i class='bx bxs-envelope'></i> contact@kknkutabawa.site
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p class="mt-3 text-center fs-7">Copyright &copy;{{ date('Y') }}. All rights reserved.</p>
    </div>
</footer>