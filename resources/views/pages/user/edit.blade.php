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
            <a href="{{ route('user.index') }}" class="text-dark d-flex align-items-center" title="Back">
                <i class='bx bx-arrow-back fs-2'></i>
            </a>
            <h4 class="py-0 my-0 text-dark fw-bold">{{ $navTitle }}</h4>
        </div>

        <!-- Danger Zone -->
        <div class="mb-3 card bg-danger">
            <div class="p-3 card-body p-lg-4">
                <h5 class="card-title text-light">Danger Zone</h5>
                <hr class="text-light">
                <div class="gap-3 delete-assets d-flex align-items-center">
                    <form id="delete-avatar-form-{{ $user->id }}"
                        action="{{ route('delete.avatar.user', $user->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-light fs-7" type="button"
                            onclick="deleteAvatar({{ $user->id }})">Delete Avatar</button>
                    </form>
                </div>
            </div>
        </div>

        <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data"
            class="gap-3 d-flex flex-column">
            @csrf @method('PUT')

            <!-- Assets -->
            <div class="card">
                <div class="p-3 card-body p-lg-4">
                    <h5 class="card-title">Assets</h5>
                    <hr class="bg-secondary">
                    <div class="user d-flex align-items-center justify-content-center">
                        <div class="avatar" style="width: 100px; height: 100px;">
                            @if ($user->avatar)
                                <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="avatar" id="image-preview">
                            @else
                                <img src="https://ui-avatars.com/api/?background=random&name={{ urlencode($user->fullname) }}" alt="avatar" id="image-preview">
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image-input">Avatar</label>
                        <input type="file" name="avatar" id="image-input" class="form-control"
                            accept=".jpg, .jpeg, .png, .webp">
                    </div>
                </div>
            </div>

            <!-- Permission -->
            <div class="card">
                <div class="p-3 card-body p-lg-4">
                    <h5 class="card-title">Permission</h5>
                    <hr class="bg-secondary">
                    <div class="gap-2 d-flex">
                        <div class="w-100">
                            <label for="roles">Role</label>
                            <select name="roles" id="roles" class="form-select" required>
                                <option value="user" {{ $user->roles == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->roles == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
    
                        <div class="w-100">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="approved" {{ $user->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="banned" {{ $user->status == 'banned' ? 'selected' : '' }}>Banned</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data -->
            <div class="card">
                <div class="p-3 card-body p-lg-4">
                    <h5 class="card-title">Data</h5>
                    <hr class="bg-secondary">
                    <div class="mb-2">
                        <label for="name">Username</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="name" placeholder="Masukkan username" value="{{ $user->name }}" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="fullname">Nama Lengkap</label>
                        <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror"
                            id="fullname" placeholder="Masukkan nama lengkap" value="{{ $user->fullname }}" required>
                        @error('fullname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="prodi">Prodi</label>
                        <select name="prodi" id="prodi" class="form-select">
                            <option value="" selected>Select</option>
                            @foreach ($prodi as $item)
                                <option value="{{ $item }}" {{ $user->prodi === $item ? 'selected' : '' }}>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="jobs-select">Penanggung Jawab</label>
                        <select class="form-select" id="jobs-select" multiple="multiple" name="jobs[]"
                            style="width: 100%;">
                            @foreach ($jobs as $job)
                                <option value="{{ $job }}"
                                    {{ in_array($job, explode(', ', $user->jobs)) ? 'selected' : '' }}>
                                    {{ $job }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="jobs" id="jobs-input" value="">
                    </div>

                    <div class="mb-3">
                        <div id="editor-container">
                            <div class="mb-2 d-flex justify-content-between align-items-center">
                                <label for="description" class="text-dark">Deskripsi</label>
                                <button onclick="toggleFullScreen()" type="button" class="gap-1 bg-transparent border-0 d-flex align-items-center">
                                    <i class="py-0 my-0 bx bx-fullscreen text-dark" id="fullscreen-icon"></i>
                                    <span class="text-dark" id="fullscreen-text">Fullscreen</span>
                                </button>
                            </div>
                            <textarea name="description" id="description">{{ $user->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="card">
                <div class="p-3 card-body p-lg-4">
                    <h5 class="card-title">Social Media</h5>
                    <hr class="bg-secondary">
                    <div class="mb-3 input-group">
                        <span class="input-group-text d-flex align-items-center justify-content-center" id="basic-addon1"
                            style="width: 40px;">
                            <i class="fa-brands fa-facebook-f"></i>
                        </span>
                        <input type="text" name="facebook" class="form-control" value="{{ $user->facebook }}"
                            placeholder="Facebook" aria-describedby="basic-addon1">
                    </div>
                    <div class="mb-3 input-group">
                        <span class="input-group-text d-flex align-items-center justify-content-center" id="basic-addon2"
                            style="width: 40px;">
                            <i class="fa-brands fa-instagram"></i>
                        </span>
                        <input type="text" name="instagram" class="form-control"
                            value="{{ $user->instagram }}" placeholder="Instagram"
                            aria-describedby="basic-addon2">
                    </div>
                    <div class="mb-3 input-group">
                        <span class="input-group-text d-flex align-items-center justify-content-center" id="basic-addon3"
                            style="width: 40px;">
                            <i class="fa-brands fa-linkedin"></i>
                        </span>
                        <input type="text" name="linkedin" class="form-control" value="{{ $user->linkedin }}"
                            placeholder="LinkedIn" aria-describedby="basic-addon3">
                    </div>
                    <div class="mb-3 input-group">
                        <span class="input-group-text d-flex align-items-center justify-content-center" id="basic-addon4"
                            style="width: 40px;">
                            <i class="fa-brands fa-x-twitter"></i>
                        </span>
                        <input type="text" name="twitter" class="form-control" value="{{ $user->twitter }}"
                            placeholder="Twitter" aria-describedby="basic-addon4">
                    </div>
                    <div class="mb-3 input-group">
                        <span class="input-group-text d-flex align-items-center justify-content-center" id="basic-addon5"
                            style="width: 40px;">
                            <i class="fa-brands fa-tiktok"></i>
                        </span>
                        <input type="text" name="tiktok" class="form-control" value="{{ $user->tiktok }}"
                            placeholder="TikTok" aria-describedby="basic-addon5">
                    </div>
                </div>
            </div>

            <!-- Ganti Password -->
            <div class="card">
                <div class="p-3 card-body p-lg-4">
                    <h5 class="card-title">Ganti Password</h5>
                    <hr class="bg-secondary">
                    <div class="mb-3">
                        <label for="password">Ganti Password</label>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" id="password"
                            placeholder="Masukkan password baru">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
    
        $('#jobs-select').select2(selectOptions).on('change', function () {
            const selectedValues = $(this).val();
            $(`#${this.id}-input`).val(selectedValues ? selectedValues.join(', ') : '');
        });
    
        $('form').on('submit', function () {
            $('#jobs-input').val($('#jobs-select').val()?.join(', ') ?? '');
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

    <script>
        function deleteAvatar(userId) {
            Swal.fire({
                icon: 'question',
                title: 'Anda Yakin?',
                text: 'Apakah Anda yakin ingin menghapus avatar ini?',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                customClass: {
                    popup: 'sw-popup',
                    title: 'sw-title',
                    htmlContainer: 'sw-text',
                    icon: 'sw-icon',
                    closeButton: 'bg-secondary border-0 shadow-none',
                    confirmButton: 'bg-danger border-0 shadow-none',
                },
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-avatar-form-' + userId).submit();
                }
            });
        }
    </script>
@endpush
