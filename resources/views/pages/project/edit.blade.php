@extends('layouts.dashboard')

@push('styles')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .navbar {
            display: none;
        }
        .sidebar {
            display: none !important;
        }
        .dashboard {
            position: relative;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
        }
    </style>
@endpush

@section('content')
    <div class="container px-0 px-md-3 px-lg-5">
        <div class="gap-2 mb-4 title d-flex align-items-center">
            <a href="{{ route('project.index') }}" class="text-dark d-flex align-items-center" title="Back">
                <i class='bx bx-arrow-back fs-2'></i>
            </a>
            <h4 class="py-0 my-0 text-dark fw-bold">{{ $navTitle }}</h4>
        </div>

        <form action="{{ route('project.update', $project->id) }}" method="POST" class="gap-3 d-flex flex-column" enctype="multipart/form-data">
            @csrf @method('PUT')

            <!-- Assets -->
            <div class="card">
                <div class="p-3 card-body p-lg-4">
                    <h5 class="card-title">Assets</h5>
                    <hr class="bg-secondary">
                    <div class="user d-flex align-items-center justify-content-center">
                        <div class="rounded thumbnail-preview">
                            <img src="{{ $project->thumbnail ? asset('storage/thumbnails/' . $project->thumbnail) : asset('assets/img/thumbnail.png') }}" alt="thumbnail" id="image-preview" width="100%">
                        </div>
                    </div>
                    <div class="my-3">
                        <label for="image-input">Upload thumbnail</label>
                        <input type="file" name="thumbnail" id="image-input" class="form-control"
                            accept=".jpg, .jpeg, .png, .webp">
                    </div>
                </div>
            </div>
            
            <!-- Data -->
            <div class="card">
                <div class="p-3 card-body p-lg-4">
                    <h5 class="card-title">Data</h5>
                    <hr class="bg-secondary">
                    <div class="mb-3">
                        <label for="category-select">Kategori</label>
                        <select class="form-select" id="category-select" multiple="multiple" name="category[]"
                            style="width: 100%;" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->name }}"
                                    {{ in_array($category->name, explode(', ', $project->category)) ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="category" id="category-input" value="" required>
                        @error('category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="title">Judul</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            id="title" placeholder="Masukkan judul" value="{{ old('title', $project->title) }}" required>
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div id="editor-container">
                            <div class="mb-2 d-flex justify-content-between align-items-center">
                                <label for="description" class="text-dark">Isi konten</label>
                                <button onclick="toggleFullScreen()" type="button" class="gap-1 bg-transparent border-0 d-flex align-items-center">
                                    <i class="py-0 my-0 bx bx-fullscreen text-dark" id="fullscreen-icon"></i>
                                    <span class="text-dark" id="fullscreen-text">Fullscreen</span>
                                </button>
                            </div>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" required>{{ old('description', $project->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-grid d-md-flex justify-content-md-end w-100">
                <button class="px-4 py-2 rounded-20 btn btn-primary" type="submit">Simpan</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        const selectOptions = {
            tags: true,
            placeholder: 'Select',
            allowClear: true,
            width: '100%',
        };
    
        $('#category-select').select2(selectOptions).on('change', function () {
            const selectedValues = $(this).val();
            $(`#${this.id}-input`).val(selectedValues ? selectedValues.join(', ') : '');
        });
    
        $('form').on('submit', function () {
            $('#category-input').val($('#category-select').val()?.join(', ') ?? '');
        });
    </script>

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
