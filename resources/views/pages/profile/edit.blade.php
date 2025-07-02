@extends('layouts.dashboard')

@push('styles')
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
    <div class="container">
        <div class="gap-2 mb-4 title d-flex align-items-center">
            <a href="{{ route('profile.index') }}" class="text-dark d-flex align-items-center" title="Back">
                <i class='bx bx-arrow-back fs-2'></i>
            </a>
            <h4 class="py-0 my-0 text-dark fw-bold">Edit Profile</h4>
        </div>

        <!-- Danger Zone -->
        <div class="mb-3 card bg-danger">
            <div class="p-3 card-body p-lg-4">
                <h6 class="card-title text-light">Danger Zone</h6>
                <hr class="text-light">
                <div class="gap-3 delete-assets d-flex align-items-center">
                    <form id="delete-avatar-form-{{ Auth::user()->id }}"
                        action="{{ route('delete.avatar', Auth::user()->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-light fs-7" type="button"
                            onclick="deleteAvatar({{ Auth::user()->id }})">Delete Avatar</button>
                    </form>
                </div>
            </div>
        </div>

        <form action="{{ route('profile.update', Auth::user()->id) }}" method="post" enctype="multipart/form-data"
            class="gap-3 d-flex flex-column">
            @csrf @method('PUT')

            <!-- Assets -->
            <div class="card">
                <div class="p-3 card-body p-lg-4">
                    <h5 class="card-title">Assets</h5>
                    <hr class="bg-secondary">
                    <div class="mb-3">
                        <label for="avatar">Avatar</label>
                        <input type="file" name="avatar" id="avatar" class="form-control"
                            accept=".jpg, .jpeg, .png, .webp">
                    </div>
                </div>
            </div>

            <!-- Data -->
            <div class="card">
                <div class="p-3 card-body p-lg-4">
                    <h5 class="card-title">Data</h5>
                    <hr class="bg-secondary">
                    <div class="mb-2">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="name" placeholder="Masukkan namamu" value="{{ Auth::user()->name }}" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="prodi-select">Prodi</label>
                        <select class="form-select" id="prodi-select" name="prodi" style="width: 100%;">
                            @foreach ($prodi as $item)
                                <option value="{{ $item }}" {{ Auth::user()->prodi === $item ? 'selected' : '' }}>
                                    {{ $item }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="prodi" id="prodi-input" value="">
                    </div>

                    <div class="mb-3">
                        <label for="jobs-select">Penanggung Jawab</label>
                        <select class="form-select" id="jobs-select" multiple="multiple" name="jobs[]"
                            style="width: 100%;">
                            @foreach ($jobs as $job)
                                <option value="{{ $job }}"
                                    {{ in_array($job, explode(',', Auth::user()->jobs)) ? 'selected' : '' }}>
                                    {{ $job }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="jobs" id="jobs-input" value="">
                    </div>

                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea2"
                                style="height: 100px">{{ Auth::user()->description }}</textarea>
                            <label for="floatingTextarea2">Deskripsi</label>
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
                        <input type="text" name="facebook" class="form-control" value="{{ Auth::user()->facebook }}"
                            placeholder="Facebook" aria-describedby="basic-addon1">
                    </div>
                    <div class="mb-3 input-group">
                        <span class="input-group-text d-flex align-items-center justify-content-center" id="basic-addon2"
                            style="width: 40px;">
                            <i class="fa-brands fa-instagram"></i>
                        </span>
                        <input type="text" name="instagram" class="form-control"
                            value="{{ Auth::user()->instagram }}" placeholder="Instagram"
                            aria-describedby="basic-addon2">
                    </div>
                    <div class="mb-3 input-group">
                        <span class="input-group-text d-flex align-items-center justify-content-center" id="basic-addon3"
                            style="width: 40px;">
                            <i class="fa-brands fa-linkedin"></i>
                        </span>
                        <input type="text" name="linkedin" class="form-control" value="{{ Auth::user()->linkedin }}"
                            placeholder="LinkedIn" aria-describedby="basic-addon3">
                    </div>
                    <div class="mb-3 input-group">
                        <span class="input-group-text d-flex align-items-center justify-content-center" id="basic-addon4"
                            style="width: 40px;">
                            <i class="fa-brands fa-x-twitter"></i>
                        </span>
                        <input type="text" name="twitter" class="form-control" value="{{ Auth::user()->twitter }}"
                            placeholder="Twitter" aria-describedby="basic-addon4">
                    </div>
                    <div class="mb-3 input-group">
                        <span class="input-group-text d-flex align-items-center justify-content-center" id="basic-addon5"
                            style="width: 40px;">
                            <i class="fa-brands fa-tiktok"></i>
                        </span>
                        <input type="text" name="tiktok" class="form-control" value="{{ Auth::user()->tiktok }}"
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
    
        $('#jobs-select, #prodi-select').select2(selectOptions).on('change', function () {
            const selectedValues = $(this).val();
            $(`#${this.id}-input`).val(selectedValues ? selectedValues.join(', ') : '');
        });
    
        $('form').on('submit', function () {
            $('#jobs-input').val($('#jobs-select').val()?.join(', ') ?? '');
            $('#prodi-input').val($('#prodi-select').val() ?? '');
        });
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
