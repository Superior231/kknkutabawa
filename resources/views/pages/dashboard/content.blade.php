@extends('layouts.dashboard')

@push('styles')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.css">
@endpush

@section('content')
    <form action="{{ route('content.update', $content->id) }}" class="gap-3 content d-flex flex-column" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Asset</h5>
                <hr class="bg-secondary">
                <div class="user d-flex align-items-center justify-content-center">
                    <div class="rounded thumbnail-preview">
                        @if ($content->hero_image)
                            <img src="{{ asset('storage/thumbnails/' . $content->hero_image) }}" alt="thumbnail" id="image-preview">
                        @else
                            <img src="{{ asset('assets/img/banner.jpg') }}" alt="thumbnail" id="image-preview">
                        @endif
                    </div>
                </div>
                <div class="my-3">
                    <label for="image-input">Ubah banner</label>
                    <input type="file" name="hero_image" id="image-input" class="form-control"
                        accept=".jpg, .jpeg, .png, .webp">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="p-3 card-body p-lg-4">
                <h5 class="card-title">Data</h5>
                <hr class="bg-secondary">
                <div class="mb-2">
                    <label for="label">Label</label>
                    <input type="text" name="label" class="form-control @error('label') is-invalid @enderror"
                        id="label" placeholder="Masukkan label" value="{{ $content->label }}">
                    @error('label')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="hero_title">Hero title</label>
                    <input type="text" name="hero_title" class="form-control @error('hero_title') is-invalid @enderror"
                        id="hero_title" placeholder="Masukkan hero title" value="{{ $content->hero_title }}" required>
                    @error('hero_title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="hero_description">Hero description</label>
                    <input type="text" name="hero_description" class="form-control @error('hero_description') is-invalid @enderror"
                        id="hero_description" placeholder="Masukkan hero description" value="{{ $content->hero_description }}" required>
                    @error('hero_description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row row-cols-1 row-cols-md-3 g-2">
                    <div class="col">
                        <div class="mb-2">
                            <label for="profile_population">Total populasi</label>
                            <input type="number" name="profile_population" class="form-control @error('profile_population') is-invalid @enderror"
                                id="profile_population" placeholder="Masukkan total populasi" value="{{ $content->profile_population }}" required>
                            @error('profile_population')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-2">
                            <label for="profile_area">Luas wilayah (ha)</label>
                            <input type="number" step="0.01" name="profile_area" class="form-control @error('profile_area') is-invalid @enderror"
                                id="profile_area" placeholder="Masukkan total populasi" value="{{ $content->profile_area }}" required>
                            @error('profile_area')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-2">
                            <label for="profile_profession">Profesi utama</label>
                            <input type="text" name="profile_profession" class="form-control @error('profile_profession') is-invalid @enderror"
                                id="profile_profession" placeholder="Masukkan total populasi" value="{{ $content->profile_profession }}" required>
                            @error('profile_profession')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div id="editor-container">
                        <div class="mb-2 d-flex justify-content-between align-items-center">
                            <label for="profile_description" class="text-dark">Deskripsi desa</label>
                            <button onclick="toggleFullScreen()" type="button" class="gap-1 bg-transparent border-0 d-flex align-items-center">
                                <i class="py-0 my-0 bx bx-fullscreen text-dark" id="fullscreen-icon"></i>
                                <span class="text-dark" id="fullscreen-text">Fullscreen</span>
                            </button>
                        </div>
                        <textarea name="profile_description" id="profile_description">{{ $content->profile_description }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-grid d-md-flex justify-content-md-end w-100">
            <button class="px-4 py-2 rounded-20 btn btn-primary" type="submit">Simpan</button>
        </div>
    </form>
@endsection

@push('scripts')
    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.2/"
            }
        }
    </script>
    <script type="module" src="{{ url('assets/js/ckeditor.js') }}"></script>

    <script>
        let isFullscreen = false;
    
        function toggleFullScreen() {
            const container = document.getElementById('editor-container');
            const icon = document.getElementById('fullscreen-icon');
            const text = document.getElementById('fullscreen-text');
    
            isFullscreen = !isFullscreen;
    
            if (isFullscreen) {
                container.classList.add('editor-fullscreen');
                icon.classList.remove('bx-fullscreen');
                icon.classList.add('bx-x');
                text.textContent = 'Close';
            } else {
                container.classList.remove('editor-fullscreen');
                icon.classList.remove('bx-x');
                icon.classList.add('bx-fullscreen');
                text.textContent = 'Fullscreen';
            }
        }
    </script>
@endpush
