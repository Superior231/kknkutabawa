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
                                        <div class="px-3 py-2 badge bg-primary text-light">
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
                                <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ urlencode(request()->getSchemeAndHttpHost() . '/@' . $user->name) }}&size=100x100" alt="QR Code">
                            </div>
                            <span class="text-center text-muted fs-7">{{ request()->getSchemeAndHttpHost() . '/@' . $user->name }}</span>
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
