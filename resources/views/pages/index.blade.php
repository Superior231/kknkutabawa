@extends('layouts.main')

@section('content')
    @include('components.loading')
    @include('components.navbar')
    <section class="banner position-relative" id="home">
        @if ($content->hero_image)
            <img src="{{ asset('storage/thumbnails/' . $content->hero_image) }}" alt="hero image">
        @else
            <img src="{{ url('assets/img/banner.jpg') }}" alt="hero image">
        @endif
        <div class="container banner-content d-flex flex-column">
            <div class="banner-text">
                <h2><span class="px-3 auto-type fw-bold text-light bg-primary"></span></h2>
                <h1 class="text-light fw-bold">{{ $content->hero_title }}</h1>
                <p class="text-light-opacity col-10 col-md-10 col-lg-8">{{ $content->hero_description }}</p>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="banner-badge">
                    <a href="https://upstegal.ac.id/" target="_blank">
                        <img src="{{ url('assets/img/logoups.png') }}" alt="Logo" style="width: 30px;">
                    </a>
                    <a href="https://kampusmerdeka.kemdikbud.go.id/" target="_blank">
                        <img src="{{ url('assets/img/logokm.png') }}" alt="Logo" style="width: 40px;">
                    </a>
                    <a href="">
                        <img src="{{ url('assets/img/logo.png') }}" alt="Logo" style="width: 30px;">
                    </a>
                </div>

                <div class="px-3 banner-badge bg-primary">
                    @auth
                        <a href="{{ route('dashboard.index') }}" class="gap-2 py-1 d-flex align-items-center justify-content-center text-light fw-semibold">
                            <span>Dashboard</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="gap-2 py-1 d-flex align-items-center justify-content-center text-light fw-semibold">
                            <span>Masuk</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <section class="container py-5" id="profil-desa">
        <h1 class="fw-bold blockquote">Profil Desa</h1>
        <div class="gap-2 d-flex flex-column">
            <div class="row g-3 align-items-start">
                <div class="col col-12 col-lg-4">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56484.148123507126!2d109.25377506828681!3d-7.239321049154545!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ff17aa9ebe95f%3A0x5027a76e3551520!2sKutabawa%2C%20Kec.%20Karangreja%2C%20Kabupaten%20Purbalingga%2C%20Jawa%20Tengah!5e1!3m2!1sid!2sid!4v1751218622887!5m2!1sid!2sid" width="100%" height="375" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col col-12 col-lg-8">
                    <div class="row g-3" id="profile-stats">
                        <div class="col">
                            <div class="card border-primary h-100">
                                <div class="card-body">
                                    <div class="gap-2 d-flex">
                                        <div class="p-0 m-0 icon">
                                            <i class='p-3 bx bxs-group text-primary fs-2'></i>
                                        </div>
                                        <div class="gap-1 d-flex flex-column justify-content-center align-items-start">
                                            <h6 class="py-0 my-0 text-nowrap">Total Penduduk</h6>
                                            <h5 class="py-0 my-0 fw-bold">{{ number_format($content->profile_population, 0, ',', '.') }} Jiwa</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card border-warning h-100">
                                <div class="card-body">
                                    <div class="gap-2 d-flex">
                                        <div class="p-0 m-0 icon text-warning">
                                            <i class='p-3 bx bxs-crown fs-2'></i>
                                        </div>
                                        <div class="gap-1 d-flex flex-column justify-content-center align-items-start">
                                            <h6 class="py-0 my-0 text-nowrap">Profesi Utama</h6>
                                            <h5 class="py-0 my-0 fw-bold">{{ $content->profile_profession }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card border-success h-100">
                                <div class="card-body">
                                    <div class="gap-2 d-flex">
                                        <div class="p-0 m-0 icon">
                                            <i class='p-3 bx bx-crop text-success fs-2'></i>
                                        </div>
                                        <div class="gap-1 d-flex flex-column justify-content-center align-items-start">
                                            <h6 class="py-0 my-0 text-nowrap">Luas Wilayah</h6>
                                            <h5 class="py-0 my-0 fw-bold">{{ rtrim(rtrim(number_format($content->profile_area, 1, ',', '.'), '0'), ',') }} Hektar</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 card border-secondary" id="profile-description">
                        <div class="p-4 card-body">
                            <span>
                                {!! $content->profile_description !!}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" id="struktur-organisasi-kkn">
        <div class="container">
            <h1 class="fw-bold blockquote">Struktur Organisasi KKN</h1>
            <div class="mt-5 mb-3 row justify-content-center">
                @forelse ($users as $user)
                    @if ($user->jobs === 'Dosen Pembimbing Lapangan')
                        <div class="col col-md-auto">
                            <a href="{{ route('show.profile', $user->slug) }}" class="card">
                                <div class="gap-0 card-body d-flex justify-content-between">
                                    <div class="d-flex">
                                        <div class="avatar">
                                            @if (!empty($user->avatar))
                                                <img class="img" src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="avatar">
                                            @else
                                                <img class="img" src="https://ui-avatars.com/api/?background=random&name={{ urlencode($user->fullname) }}">
                                            @endif
                                        </div>
                                        <div class="gap-0 d-flex flex-column justify-content-center">
                                            <h6 class="py-0 my-0 username fw-bold">{{ $user->fullname }}</h6>
                                            <span class="py-0 my-0 text-muted">{{ $user->jobs }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class='bx bx-chevron-right fs-4'></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @empty
                    <h6 class="py-0 my-0 text-nowrap">Belum ada DPL</h6>
                @endforelse
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                @forelse ($users as $user)
                    @if ($user->jobs !== 'Dosen Pembimbing Lapangan' && $user->roles !== 'admin')
                        <div class="col">
                            <a href="{{ route('show.profile', $user->slug) }}" class="card">
                                <div class="gap-0 card-body d-flex justify-content-between">
                                    <div class="d-flex">
                                        <div class="avatar">
                                            @if (!empty($user->avatar))
                                                <img class="img" src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="avatar">
                                            @else
                                                <img class="img" src="https://ui-avatars.com/api/?background=random&name={{ urlencode($user->fullname) }}">
                                            @endif
                                        </div>
                                        <div class="gap-0 d-flex flex-column justify-content-center">
                                            <h6 class="py-0 my-0 username fw-bold">{{ $user->fullname }}</h6>
                                            <span class="py-0 my-0 text-muted username">{{ $user->jobs }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class='bx bx-chevron-right fs-4'></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @empty
                    <h6 class="py-0 my-0 text-nowrap">Belum ada anggota</h6>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-5" id="projects">
        <div class="container">
            <h1 class="fw-bold blockquote">Projects</h1>
            <h3 class="py-5 my-5 text-center fw-bold">COMING SOON!</h3>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
    <script>
        function typeJs(label) {
            var typed = new Typed('.auto-type', {
                strings: label,
                typeSpeed: 150,
                backSpeed: 150,
                loop: true,
                showCursor: true,
                backDelay: 1000,
                startDelay: 500,
                smartBackspace: true,
                shuffle: false,
                contentType: 'html'
            });
        }
        typeJs({!! json_encode(explode(',', $content->label)) !!});
    </script>
@endpush
