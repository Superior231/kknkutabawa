@extends('layouts.dashboard')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .row.dt-row {
            overflow-x: auto !important;
        }
    </style>
@endpush

@section('content')
    <div class="p-4 card">
        <div class="actions d-flex justify-content-between align-items-center">
            <h4 class="py-0 my-0 fw-semibold">Semua Anggota</h4>
            <button type="button" class="gap-1 px-4 py-2 rounded-20 btn btn-primary d-flex align-items-center" data-bs-toggle="modal"
                data-bs-target="#tambahSaffModal">
                <i class='bx bx-plus'></i>
                Anggota
            </button>
        </div>
        <hr>
        <table class="table table-striped" id="staffTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Jobs</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="align-middle">
                        <td>
                            <div class="gap-1 user d-flex align-items-center">
                                <div class="avatar">
                                    @if (!empty($user->avatar))
                                        <img class="img" src="{{ asset('storage/avatars/' . $user->avatar) }}">
                                    @else
                                        <img class="img"
                                            src="https://ui-avatars.com/api/?background=random&name={{ urlencode($user->name) }}">
                                    @endif
                                </div>
                                <span class="py-0 my-0 fw-medium">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="gap-1 d-flex align-items-center text-nowrap">
                                <i
                                    class='bx
                                {{ $user->roles === 'admin' ? 'bxs-wrench' : 'bxs-user' }}
                                fs-5'></i>
                                {{ $user->roles }}
                            </div>
                        </td>
                        <td>
                            <div class="gap-1 d-flex align-items-center">
                                {{ $user->jobs }}
                            </div>
                        </td>
                        <td>
                            <div class="status d-flex justify-content-center pe-3">
                                @if ($user->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-danger">Banned</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="gap-2 actions d-flex align-items-center justify-content-center pe-3">
                                <button style="cursor: pointer;"
                                    class="p-2 rounded btn btn-primary d-flex align-items-center justify-content-center"
                                    onclick="editStaff('{{ $user->id }}', '{{ $user->avatar }}', '{{ $user->name }}', '{{ $user->roles }}', '{{ $user->status }}', '{{ $user->jobs }}')"
                                    data-bs-toggle="modal" data-bs-target="#editStaffModal">
                                    <i class='p-0 m-0 bx bxs-pencil'></i>
                                </button>
                                <button style="cursor: pointer;"
                                    class="p-2 rounded btn btn-danger d-flex align-items-center justify-content-center">
                                    <i class='p-0 m-0 bx bxs-trash'></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="tambahSaffModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-fullscreen-md-down">
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="px-2 modal-content">
                    <div class="pb-0 mb-0 border-0 modal-header d-flex align-items-center justify-content-between">
                        <h4 class="modal-title" id="tambahStaffLabel">Tambah Anggota</h4>
                        <div class="close-btn" data-bs-dismiss="modal" aria-label="Close" style="cursor: pointer;">
                            <i class='bx bx-x fs-2 icon'></i>
                        </div>
                    </div>
                    <div class="modal-body">
                        <label for="roles-tambah" class="mb-2">Roles</label>
                        <select id="roles-tambah" name="roles" class="mb-3 form-select"
                            aria-label="Default select example">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>

                        <label for="nameTambah" class="mb-2">Username</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="nameTambah" value="{{ old('name') }}" placeholder="Enter username" autocomplete="off"
                            required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="mt-3 mb-2 error-message-container">
                            <label for="password-tambah">Password</label>
                            <p class="py-0 my-0 text-danger fw-bolder" id="error-message-tambah-password"></p>
                        </div>
                        <div class="content-tambah-user" id="content-tambah-password">
                            <input type="password" class="form-control" name="password" id="password-tambah"
                                placeholder="Enter password" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="border-0 modal-footer">
                        <button type="button" class="px-4 btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="px-4 btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="editStaffModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
            <div class="px-2 modal-content">
                <div class="border-0 modal-header d-flex align-items-center justify-content-between">
                    <h4 class="modal-title" id="editStaffLabel">Edit Anggota</h4>
                    <div class="close-btn" data-bs-dismiss="modal" aria-label="Close" style="cursor: pointer;">
                        <i class='bx bx-x text-color fs-2 icon'></i>
                    </div>
                </div>

                <form action="" method="POST" enctype="multipart/form-data" id="editStaffForm">
                    @csrf @method('PUT')

                    <div class="modal-body">
                        <figure class="gap-3 mb-4 profile d-flex flex-column justify-content-center align-items-center">
                            <div class="foto-profile">
                                <img class="img-avatar" id="img">
                            </div>
                        </figure>
                        <label for="input-img" class="mb-2">Upload foto (jpg, jpeg, png, dan webp)</label>
                        <input type="file" class="form-control" name="avatar" id="input-img" accept="image/*">

                        <div class="gap-2 d-flex align-items-center w-100">
                            <div class="mt-3 w-100">
                                <label for="edit-roles" class="mb-1">Roles</label>
                                <select class="form-select" name="roles" id="edit-roles" required>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            <div class="mt-3 w-100">
                                <label for="edit-status" class="mb-1">Status</label>
                                <select class="form-select" name="status" id="edit-status" required>
                                    <option value="approved">Approved</option>
                                    <option value="suspend">Suspend</option>
                                </select>
                            </div>
                        </div>

                        <div class="gap-2 d-flex w-100">
                            <div class="jobs w-100">
                                <label for="jobs-select" class="mt-3 mb-1">Jobs</label>
                                <select class="form-select" id="jobs-select" multiple="multiple" name="jobs[]"
                                    style="width: 100%;">
                                    @foreach ($jobs as $job)
                                        <option value="{{ $job }}">{{ $job }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="jobs" id="jobs-input" value="">
                            </div>
                            <div class="prodi w-100">
                                <label for="prodi-select" class="mt-3 mb-1">Prodi</label>
                                <select class="form-select" id="prodi-select" multiple="multiple" name="prodi[]"
                                    style="width: 100%;">
                                    @foreach ($prodi as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="prodi" id="prodi-input" value="">
                            </div>
                        </div>

                        <label for="edit-username" class="mt-3 mb-1">Username</label>
                        <input type="text" class="form-control text-color" name="name" id="edit-username"
                            placeholder="Enter username" autocomplete="off" required>

                        <div class="mt-3">
                            <label for="edit-password" class="mb-1">Password Baru</label>
                            <input type="password" class="form-control text-color" name="password" id="edit-password"
                                placeholder="Enter new password" autocomplete="off">
                        </div>
                    </div>

                    <div class="border-0 modal-footer">
                        <button type="button" class="px-4 btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="px-4 btn btn-primary" id="save-edit-profile-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        let select2Initialized = false;

        $('#editStaffModal').on('shown.bs.modal', function() {
            if (!select2Initialized) {
                $('#jobs-select').select2({
                    tags: true,
                    placeholder: "Select jobs",
                    dropdownParent: $('#editStaffModal'),
                    allowClear: true,
                    width: '100%'
                }).on('change', function() {
                    const selectedValues = $(this).val();
                    $('#jobs-input').val(selectedValues ? selectedValues.join(', ') : '');
                });
                $('#prodi-select').select2({
                    tags: true,
                    placeholder: "Select prodi",
                    dropdownParent: $('#editStaffModal'),
                    allowClear: true,
                    width: '100%'
                }).on('change', function() {
                    const selectedValues = $(this).val();
                    $('#prodi-input').val(selectedValues ? selectedValues.join(', ') : '');
                });

                select2Initialized = true;
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#staffTable').DataTable({
                "language": {
                    "searchPlaceholder": "Search..."
                }
            });
        });

        function editStaff(id, avatar, name, roles, status, jobs) {
            var avatarUrl = avatar ? '{{ asset('storage/avatars') }}/' + avatar :
                `https://ui-avatars.com/api/?background=random&name=${encodeURIComponent(name)}`;

            $('#img').attr('src', avatarUrl);
            $('#input-img').val('');
            $('#edit-username').val(name);
            $('#edit-roles').val(roles);
            $('#edit-status').val(status);
            $('#edit-jobs').val(jobs);

            $('#editStaffForm').attr('action', "{{ route('users.update', '') }}" + '/' + id);
        }
    </script>
@endpush
