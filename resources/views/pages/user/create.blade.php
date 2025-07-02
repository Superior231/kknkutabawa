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
            <a href="{{ route('user.index') }}" class="text-dark d-flex align-items-center" title="Back">
                <i class='bx bx-arrow-back fs-2'></i>
            </a>
            <h4 class="py-0 my-0 text-dark fw-bold">{{ $navTitle }}</h4>
        </div>

        <form action="{{ route('user.store') }}" method="POST" class="gap-3 d-flex flex-column">
            @csrf

            <!-- Permission -->
            <div class="card bg-primary text-light">
                <div class="p-3 card-body p-lg-4">
                    <h5 class="card-title">Permission</h5>
                    <hr class="bg-secondary">
                    <div class="gap-2 d-flex">
                        <div class="w-100">
                            <label for="roles">Role</label>
                            <select name="roles" id="roles" class="bg-transparent border-secondary text-light form-select" required>
                                <option value="user" class="text-color" selected>User</option>
                                <option value="admin" class="text-color">Admin</option>
                            </select>
                        </div>
    
                        <div class="w-100">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="bg-transparent border-secondary text-light form-select" required>
                                <option value="approved" class="text-color" selected>Approved</option>
                                <option value="suspend" class="text-color">Suspend</option>
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
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="name" placeholder="Masukkan namamu" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="prodi-select">Prodi</label>
                        <select class="form-select" id="prodi-select" name="prodi" style="width: 100%;">
                            <option value="">Select</option>
                            @foreach ($prodi as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="prodi" id="prodi-input" value="">
                    </div>

                    <div class="mb-3">
                        <label for="jobs-select">Penanggung Jawab</label>
                        <select class="form-select" id="jobs-select" multiple="multiple" name="jobs[]"
                            style="width: 100%;">
                            @foreach ($jobs as $job)
                                <option value="{{ $job }}">{{ $job }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="jobs" id="jobs-input" value="">
                    </div>

                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea2"
                                style="height: 100px">{{ old('description') }}</textarea>
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
                        <input type="text" name="facebook" class="form-control" value="{{ old('facebook') }}"
                            placeholder="Facebook" aria-describedby="basic-addon1">
                    </div>
                    <div class="mb-3 input-group">
                        <span class="input-group-text d-flex align-items-center justify-content-center" id="basic-addon2"
                            style="width: 40px;">
                            <i class="fa-brands fa-instagram"></i>
                        </span>
                        <input type="text" name="instagram" class="form-control"
                            value="{{ old('instagram') }}" placeholder="Instagram"
                            aria-describedby="basic-addon2">
                    </div>
                    <div class="mb-3 input-group">
                        <span class="input-group-text d-flex align-items-center justify-content-center" id="basic-addon3"
                            style="width: 40px;">
                            <i class="fa-brands fa-linkedin"></i>
                        </span>
                        <input type="text" name="linkedin" class="form-control" value="{{ old('linkedin') }}"
                            placeholder="LinkedIn" aria-describedby="basic-addon3">
                    </div>
                    <div class="mb-3 input-group">
                        <span class="input-group-text d-flex align-items-center justify-content-center" id="basic-addon4"
                            style="width: 40px;">
                            <i class="fa-brands fa-x-twitter"></i>
                        </span>
                        <input type="text" name="twitter" class="form-control" value="{{ old('twitter') }}"
                            placeholder="Twitter" aria-describedby="basic-addon4">
                    </div>
                    <div class="mb-3 input-group">
                        <span class="input-group-text d-flex align-items-center justify-content-center" id="basic-addon5"
                            style="width: 40px;">
                            <i class="fa-brands fa-tiktok"></i>
                        </span>
                        <input type="text" name="tiktok" class="form-control" value="{{ old('tiktok') }}"
                            placeholder="TikTok" aria-describedby="basic-addon5">
                    </div>
                </div>
            </div>

            <!-- Ganti Password -->
            <div class="card">
                <div class="p-3 card-body p-lg-4">
                    <h5 class="card-title">Password</h5>
                    <hr class="bg-secondary">
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" id="password"
                            placeholder="Masukkan password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            id="password_confirmation" placeholder="Masukkan konfirmasi password">
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-grid d-md-flex justify-content-md-end w-100">
                <button class="px-4 py-2 rounded-20 btn btn-primary" type="submit">Tambah</button>
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
                confirmButtonText: 'Hapus',
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

