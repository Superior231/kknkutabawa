@extends('layouts.main')

@section('content')
    @include('components.navbar')
    <section id="profile">
        <div class="container">
            <div class="row g-1 g-lg-3">
                <div class="col col-12 col-lg-8">
                    <div class="mt-3 card card-profile">
                        <img src="{{ url('/assets/img/banner-profile.png') }}" class="card-img-top" alt="">
                        <div class="header">
                            <div class="avatar">
                                @if (!empty($user->avatar))
                                    <img class="img" src="{{ asset('storage/avatars/' . $user->avatar) }}"
                                        lt="avatar">
                                @else
                                    <img class="img"
                                        src="https://ui-avatars.com/api/?background=random&name={{ urlencode($user->fullname) }}">
                                @endif
                            </div>
                            <div class="flex-wrap gap-1 jobs d-flex align-items-center">
                                @if ($user->jobs)
                                    @foreach (explode(',', $user->jobs) as $job)
                                        <div class="px-3 py-2 badge bg-primary text-warning" style="border-left: none !important;">
                                            <span>{{ $job }}</span>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="px-3 py-2 badge bg-primary text-light">
                                        <span>Tidak ada</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold">{{ $user->fullname }}</h5>
                            <div class="card-text">
                                @if ($user->description)
                                    {!! $user->description !!}
                                @else
                                    Belum ada deskripsi.
                                @endif
                            </div>
                        </div>
                        <div class="card-footer" id="social-media">
                            <ul class="mb-0 list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ $user->facebook ? $user->facebook : '#' }}" target="_blank" rel="noopener noreferrer" title="Facebook">
                                        <i class="fa-brands fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{ $user->instagram ? $user->instagram : '#' }}" target="_blank" rel="noopener noreferrer" title="Instagram">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{ $user->linkedin ? $user->linkedin : '#' }}" target="_blank" rel="noopener noreferrer" title="LinkedIn">
                                        <i class="fa-brands fa-linkedin"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{ $user->twitter ? $user->twitter : '#' }}" target="_blank" rel="noopener noreferrer" title="Twitter">
                                        <i class="fa-brands fa-x-twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{ $user->tiktok ? $user->tiktok : '#' }}" target="_blank" rel="noopener noreferrer" title="TikTok">
                                        <i class="fa-brands fa-tiktok"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col col-12 col-lg-4 sticky-top" id="other-members">
                    <div class="mt-3 card">
                        <div class="card-header d-flex align-items-center">
                            <h6 class="py-2 my-0 fw-bold">Scan here!</h6>
                        </div>
                        <div class="gap-1 card-body d-flex flex-column align-items-center justify-content-center">
                            <div class="qr-code">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ urlencode(request()->getSchemeAndHttpHost() . '/@' . $user->slug) }}&size=100x100" alt="QR Code" id="qr-code" data-filename="{{ $user->slug }}">
                            </div>
                            <span class="text-center text-muted fs-7">{{ request()->getSchemeAndHttpHost() . '/@' . $user->slug }}</span>
                            <div class="gap-2 d-grid d-md-flex justify-content-md-center w-100">
                                <button class="gap-1 btn-primary d-flex align-items-center justify-content-center" id="download-qr-btn">
                                    <i class='bx bxs-download'></i> QR Code
                                </button>
                                <button class="gap-1 btn-outline-primary d-flex align-items-center justify-content-center" id="copy-link">
                                    <i class='bx bxs-copy'></i> Copy Link
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 card">
                        <div class="card-header">
                            <h6 class="py-2 my-0 fw-bold">Anggota lain</h6>
                        </div>
                        <div class="pt-0 mt-0 card-body">
                            @forelse ($users as $item)
                                @if ($item->roles !== 'admin' && $item->slug !== $user->slug)
                                    <a href="{{ route('show.profile', $item->slug) }}" class="gap-1 member d-flex align-items-center">
                                        <div class="avatar" style="width: 50px; height: 50px;">
                                            @if (!empty($item->avatar))
                                                <img class="img" src="{{ asset('storage/avatars/' . $item->avatar) }}"
                                                    lt="avatar">
                                            @else
                                                <img class="img" src="https://ui-avatars.com/api/?background=random&name={{ urlencode($item->fullname) }}">
                                            @endif
                                        </div>
                                        <div class="info d-flex flex-column justify-content-center">
                                            <h6 class="py-0 my-0 username">{{ $item->fullname }}</h6>
                                            <p class="py-0 my-0 role text-muted fs-7 username">{{ $item->jobs }}</p>
                                        </div>
                                    </a>
                                @endif
                            @empty
                                <p class="py-2 my-0 text-muted">Belum ada anggota</p>
                            @endforelse
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.getElementById('download-qr-btn').addEventListener('click', function () {
            const qrImage = document.getElementById('qr-code');
            const imageUrl = qrImage.src;
            const filename = qrImage.getAttribute('data-filename') || 'qr-code';
        
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            const img = new Image();
        
            img.crossOrigin = 'Anonymous'; // agar tidak kena CORS
            img.onload = function () {
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);
        
                const link = document.createElement('a');
                link.href = canvas.toDataURL('image/png');
                link.download = 'qr-code-' + filename + '.png';
                link.click();
            };
        
            img.src = imageUrl;
        });

        document.getElementById('copy-link').addEventListener('click', function () {
            const link = document.createElement('input');
            link.value = '{{ request()->getSchemeAndHttpHost() . '/@' . $user->slug }}';
            document.body.appendChild(link);
            link.select();
            document.execCommand('copy');
            document.body.removeChild(link);

            const icon = this.querySelector('i');
            icon.classList.remove('bxs-copy');
            icon.classList.add('bx-check');

            setTimeout(function () {
                icon.classList.remove('bx-check');
                icon.classList.add('bxs-copy');
            }, 3000);
        });
    </script>
@endpush
