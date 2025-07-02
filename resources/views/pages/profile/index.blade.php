@extends('layouts.dashboard')

@section('content')
    <section id="profile">
        <div class="mt-3 me-md-3 me-0 card card-profile">
            <img src="{{ url('/assets/img/banner-profile.png') }}" class="card-img-top" alt="">
            <div class="header">
                <div class="avatar">
                    @if (Auth::user()->avatar)
                        <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" alt="avatar">
                    @else
                        <img src="https://ui-avatars.com/api/?background=random&name={{ urlencode(Auth::user()->name) }}"
                            alt="avatar">
                    @endif
                </div>
                <div class="flex-wrap gap-2 jobs d-flex align-items-center">
                    @if (Auth::user()->jobs)
                        @foreach (explode(',', Auth::user()->jobs) as $job)
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
                <a href="{{ route('profile.edit', Auth::user()->slug) }}" class="end-0 me-4 position-absolute edit-profile" style="top: -50px;"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile">
                    <i class='p-0 m-0 bx bxs-pencil fs-3 text-color'></i>
                </a>
                <h5 class="fw-bold">{{ Auth::user()->fullname }}</h5>
                <div class="card-text">
                    @if (Auth::user()->description)
                        {!! Auth::user()->description !!}
                    @else
                        Belum ada deskripsi.
                    @endif
                </div>
            </div>
            <div class="card-footer" id="social-media">
                <ul class="mb-0 list-inline">
                    <li class="list-inline-item">
                        <a href="{{ Auth::user()->facebook ? Auth::user()->facebook : '#' }}" target="_blank" rel="noopener noreferrer" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ Auth::user()->instagram ? Auth::user()->instagram : '#' }}" target="_blank" rel="noopener noreferrer" data-bs-toggle="tooltip" data-bs-placement="top" title="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ Auth::user()->linkedin ? Auth::user()->linkedin : '#' }}" target="_blank" rel="noopener noreferrer" data-bs-toggle="tooltip" data-bs-placement="top" title="LinkedIn">
                            <i class="fa-brands fa-linkedin"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ Auth::user()->twitter ? Auth::user()->twitter : '#' }}" target="_blank" rel="noopener noreferrer" data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ Auth::user()->tiktok ? Auth::user()->tiktok : '#' }}" target="_blank" rel="noopener noreferrer" data-bs-toggle="tooltip" data-bs-placement="top" title="TikTok">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
@endsection
