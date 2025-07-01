@extends('layouts.main')

@section('content')
    @include('components.navbar')
    <section class="banner position-relative" id="home">
        <img src="{{ url('assets/img/banner.jpg') }}" alt="Banner Image">
        <div class="container banner-content d-flex flex-column">
            <div class="banner-text">
                <h2><span class="px-3 auto-type fw-bold text-light bg-primary"></span></h2>
                <h1 class="text-light fw-bold">KKN Desa Kutabawa Tahun 2025</h1>
                <p class="text-light">Universitas Pancasakti Tegal</p>
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
                    <a href="{{ route('login') }}" class="gap-2 py-1 d-flex align-items-center justify-content-center text-light fw-semibold">
                        <span>Masuk</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
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
                                            <h5 class="py-0 my-0 fw-bold">8.656 Jiwa</h5>
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
                                            <h5 class="py-0 my-0 fw-bold">Petani</h5>
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
                                            <h5 class="py-0 my-0 fw-bold">762 Hektar</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 card border-secondary" id="profile-description">
                        <div class="p-4 card-body">
                            <span>
                                Kutabawa adalah desa di kecamatan Karangreja, Purbalingga, Jawa Tengah, Indonesia. Di Kutabawa berlokasi pos awal pendakian ke Gunung Slamet (Pos Bambangan) dari sisi timur. Tempat ini populer di kalangan pendaki. Kutabawa dapat ditempuh dari terminal Purbalingga dengan menggunakan angkutan desa (Daihatsu minibus). Kutabawa adalah pusat STA, Perdangan Sayur Mayur terbesar di Jawa Tengah, STA kutabawa memasok sayuran seperti Cabe, Tomat, Kubis, Bawang, Sledri, Kentang, Ke berbagai kota seperti Jakarata, Cirebon, Ajibarang, Semarang, Yogyakarta, dan hampir di seluruh kota - kota di jawa.
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
                <div class="col col-md-auto">
                    <a href="#" class="card">
                        <div class="gap-0 card-body d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="/assets/img/nadia.png">
                                </div>
                                <div class="gap-0 d-flex flex-column justify-content-center">
                                    <h6 class="py-0 my-0 username fw-bold">Nadya Shafira Salsabilla, ST., MT</h6>
                                    <span class="py-0 my-0 text-muted">Dosen Pembimbing</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <i class='bx bx-chevron-right fs-4'></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                <div class="col">
                    <a href="profile.html" class="card">
                        <div class="gap-0 card-body d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="/assets/img/dani.png">
                                </div>
                                <div class="gap-0 d-flex flex-column justify-content-center">
                                    <h6 class="py-0 my-0 username fw-bold">Ahmad Dani Saputra</h6>
                                    <span class="py-0 my-0 text-muted">Koordinator Desa</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <i class='bx bx-chevron-right fs-4'></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <a href="#" class="card">
                        <div class="gap-0 card-body d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="/assets/img/ade.png">
                                </div>
                                <div class="gap-0 d-flex flex-column justify-content-center">
                                    <h6 class="py-0 my-0 username fw-bold">Ade Saputra</h6>
                                    <span class="py-0 my-0 text-muted">Wakil Koordinator Desa</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <i class='bx bx-chevron-right fs-4'></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <a href="#" class="card">
                        <div class="gap-0 card-body d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="/assets/img/jafar.png">
                                </div>
                                <div class="gap-0 d-flex flex-column justify-content-center">
                                    <h6 class="py-0 my-0 username fw-bold">Muhammad Syeh Abdul Jafar</h6>
                                    <span class="py-0 my-0 text-muted">Pilar Lingkungan</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <i class='bx bx-chevron-right fs-4'></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <a href="#" class="card">
                        <div class="gap-0 card-body d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="/assets/img/fitri.png">
                                </div>
                                <div class="gap-0 d-flex flex-column justify-content-center">
                                    <h6 class="py-0 my-0 username fw-bold">Fitria Dwi Setyani</h6>
                                    <span class="py-0 my-0 text-muted">Pilar Pendidikan</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <i class='bx bx-chevron-right fs-4'></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <a href="#" class="card">
                        <div class="gap-0 card-body d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="/assets/img/efi.png">
                                </div>
                                <div class="gap-0 d-flex flex-column justify-content-center">
                                    <h6 class="py-0 my-0 username fw-bold">Efi Handayani</h6>
                                    <span class="py-0 my-0 text-muted">Pilar Jati Diri</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <i class='bx bx-chevron-right fs-4'></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <a href="#" class="card">
                        <div class="gap-0 card-body d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="/assets/img/reena.png">
                                </div>
                                <div class="gap-0 d-flex flex-column justify-content-center">
                                    <h6 class="py-0 my-0 username fw-bold">Reena Della Sylvia</h6>
                                    <span class="py-0 my-0 text-muted">Pilar Pendidikan</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <i class='bx bx-chevron-right fs-4'></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <a href="#" class="card">
                        <div class="gap-0 card-body d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="/assets/img/hikmal.png">
                                </div>
                                <div class="gap-0 d-flex flex-column justify-content-center">
                                    <h6 class="py-0 my-0 username fw-bold">Hikmal Falah Agung Maulana</h6>
                                    <span class="py-0 my-0 text-muted">Pilar Kesehatan</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <i class='bx bx-chevron-right fs-4'></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <a href="#" class="card">
                        <div class="gap-0 card-body d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="/assets/img/fikri.png">
                                </div>
                                <div class="gap-0 d-flex flex-column justify-content-center">
                                    <h6 class="py-0 my-0 username fw-bold">Fikri Hidayat</h6>
                                    <span class="py-0 my-0 text-muted">Pilar Jati Diri</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <i class='bx bx-chevron-right fs-4'></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <a href="#" class="card">
                        <div class="gap-0 card-body d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="/assets/img/yoga.png">
                                </div>
                                <div class="gap-0 d-flex flex-column justify-content-center">
                                    <h6 class="py-0 my-0 username fw-bold">Yoga Pratama</h6>
                                    <span class="py-0 my-0 text-muted">Pilar Kesehatan</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <i class='bx bx-chevron-right fs-4'></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <a href="#" class="card">
                        <div class="gap-0 card-body d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="/assets/img/april.png">
                                </div>
                                <div class="gap-0 d-flex flex-column justify-content-center">
                                    <h6 class="py-0 my-0 username fw-bold">Aprilla Dwi Nazarina</h6>
                                    <span class="py-0 my-0 text-muted">Pilar Ekonomi</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <i class='bx bx-chevron-right fs-4'></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <a href="#" class="card">
                        <div class="gap-0 card-body d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="/assets/img/wulan.png">
                                </div>
                                <div class="gap-0 d-flex flex-column justify-content-center">
                                    <h6 class="py-0 my-0 username fw-bold">Dika Wulandari</h6>
                                    <span class="py-0 my-0 text-muted">Pilar Ekonomi</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <i class='bx bx-chevron-right fs-4'></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
    <script>
        function typeJs(strings) {
            var typed = new Typed('.auto-type', {
                strings,
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
        typeJs(["Kerjasama", "Kolaborasi", "Kreativitas"]);
    </script>
@endpush
