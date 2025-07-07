@extends('layouts.main')

@push('styles')
    <style>
        body {
            background-color: #fffefe !important;
        }
        nav.navbar {
            display: none !important;
        }
    </style>
@endpush

@section('content')
    <nav class="navbar-detail sticky-top">
        <div class="container gap-2 py-3 d-flex align-items-center">
            <a href="{{ route('home') }}" class="py-0 my-0 text-dark" title="Back">
                <i class='py-0 my-0 mt-1 bx bx-arrow-back fw-bold'></i>
            </a>
            <span class="py-0 my-0 fs-6 project-title-nav fw-bold">{{ $project->title }}</span>
        </div>
    </nav>

    <section class="py-0 my-0 thumbnail">
        <img src="{{ url('storage/thumbnails/' . $project->thumbnail) }}" alt="thumbnail">
    </section>

    <section class="bg-soft-blue project-container">
        <div class="container px-3 pt-5 pb-4 px-md-5">
            <h1 class="text-dark fw-bold">
                {{ $project->title }}
            </h1>
            <p class="mb-0 text-secondary fs-7">Kategori : {{ str_replace(',', ', ', $project->category) }}</p>
            <hr class="bg-secondary">
            <div class="gap-2 author d-flex">
                <a href="{{ route('show.profile', ['slug' => $author->slug]) }}" class="avatar" style="width: 40px; height: 40px;">
                    @if (!empty($project->user->avatar))
                        <img class="img" src="{{ asset('storage/avatars/' . $project->user->avatar) }}">
                    @else
                        <img class="img" src="https://ui-avatars.com/api/?background=random&name={{ urlencode($project->user->fullname) }}">
                    @endif
                </a>
                <div class="info d-flex flex-column">
                    <a href="{{ route('show.profile', ['slug' => $author->slug]) }}" class="author-name">
                        <p class="py-0 my-0 username text-primary fw-semibold">{{ $author->fullname }}</p>
                        <p class="py-0 my-0 text-secondary fs-7">&#64;{{ $author->slug }}</p>
                    </a>                                     
                    <a class="gap-1 p-0 m-0 d-flex align-items-center" onclick="viewDetails('{{ $project->id }}')">
                        <p class="mb-0 text-secondary fs-7">Diperbarui pada {{ Carbon\Carbon::parse($project->updated_at)->translatedFormat('d F Y, H:i') }} WIB</p>
                        <i class='bx bx-chevron-down text-secondary' id="icon-down-{{ $project->id }}"></i>
                        <i class='bx bx-chevron-up text-secondary' id="icon-up-{{ $project->id }}"></i>
                    </a>
                    <div class="view-details" id="view-details-{{ $project->id }}">
                        <p class="mb-0 text-secondary fs-7">Diterbitkan pada {{ Carbon\Carbon::parse($project->created_at)->translatedFormat('d F Y, H:i') }} WIB</p>
                    </div>
                </div>
            </div>
            
            <div class="gap-2 actions d-flex align-items-center justify-content-between">
                <div class="share">
                    <button onclick="shareToFacebook('{{ url('/detail/' . $project->slug) }}')" class="facebook" title="Share to Facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </button>
                    <button onclick="shareToX('{{ url('/detail/' . $project->slug) }}', '{{ $project->title }}')" class="x" title="Share to X">
                        <i class="fa-brands fa-x-twitter"></i>
                    </button>
                    <button onclick="shareToEmail('{{ url('/detail/' . $project->slug) }}', '{{ $project->title }}')" class="email" title="Share to Email">
                        <i class="fa-solid fa-envelope"></i>
                    </button>
                    <button onclick="copyLink('{{ $project->id }}')" class="copy-link-btn" id="copy-link-btn-{{ $project->id }}" title="Copy Link">
                        <p class="p-0 m-0 copy-link-text fs-7" id="copy-link-text-{{ $project->id }}">
                            <i class="fa-solid fa-copy"></i>
                        </p>
                        <input type="text" id="copy-link-{{ $project->id }}" value="{{ url('/detail/' . $project->slug) }}" hidden>
                    </button>
                </div>
            </div>

            <div class="mt-4 read-time d-flex align-items-center justify-content-end text-secondary">
                <div class="gap-1 px-4 py-2 d-flex align-items-center justify-content-center bg-primary text-light rounded-pill">
                    <i class='bx bx-stopwatch fs-5'></i>
                    <p class="py-0 my-0 fs-7">
                        {{ $readTime }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="row row-cols-1 project-container g-0">
        <section class="py-4 col project-body py-lg-5">
            <div class="container px-3 px-md-5">
                <div class="thumbnail">
                    <img src="{{ url('storage/thumbnails/' . $project->thumbnail) }}" alt="thumbnail" class="mb-5 rounded-2">
                </div>
                <div class="px-0 mx-0 text-break">
                    {!! $project->description !!}
                </div>
            </div>
        </section>
    </div>
@endsection
