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
            <h4 class="py-0 my-0 fw-semibold">Semua User</h4>
            <a href="{{ route('user.create') }}" class="gap-1 px-4 py-2 rounded-20 btn btn-primary d-flex align-items-center">
                <i class='bx bx-plus'></i>
                Tambah
            </a>
        </div>
        <hr>
        <table class="table table-striped table-hover" id="staffTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Jobs</th>
                    <th>Prodi</th>
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
                                            src="https://ui-avatars.com/api/?background=random&name={{ urlencode($user->fullname) }}">
                                    @endif
                                </div>
                                <span class="py-0 my-0 fw-medium username" data-bs-toggle="tooltip" title="{{ $user->fullname }}">{{ $user->fullname }}</span>
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
                            @foreach (explode(', ', $user->jobs) as $job)
                                <span class="badge bg-primary rounded-pill {{ $user->jobs === 'Dosen Pembimbing Lapangan' ? 'text-warning' : 'text-light' }}">{{ $job }}</span>
                            @endforeach
                        </td>
                        <td>
                            <span class="py-0 my-0 fw-medium text-nowrap">{{ $user->prodi }}</span>
                        </td>
                        <td>
                            <div class="status d-flex justify-content-center pe-3">
                                @if ($user->status == 'approved')
                                    <i class='bx bxs-check-circle text-success fs-3'></i>
                                @else
                                    <i class='bx bxs-x-circle text-danger fs-3'></i>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="gap-2 actions d-flex align-items-center justify-content-center pe-3">
                                <a href="{{ route('user.edit', $user->id) }}" style="cursor: pointer;"
                                    class="p-2 rounded btn btn-primary d-flex align-items-center justify-content-center">
                                    <i class='p-0 m-0 bx bxs-pencil'></i>
                                </a>

                                @if (Auth::user()->id !== $user->id)
                                    <form id="delete-user-form-{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        
                                        <button type="button" style="cursor: pointer;"
                                            class="p-2 rounded btn btn-danger d-flex align-items-center justify-content-center" onclick="confirmDeleteUser({{ $user->id }})">
                                            <i class='p-0 m-0 bx bxs-trash'></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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

        function confirmDeleteUser(userId) {
            Swal.fire({
                icon: 'question',
                title: 'Anda Yakin?',
                text: 'Apakah Anda yakin ingin menghapus user ini?',
                confirmButtonText: 'Delete',
                showCancelButton: true,
                customClass: {
                    popup: 'sw-popup',
                    title: 'sw-title',
                    htmlContainer: 'sw-text',
                    icon: 'sw-icon',
                    closeButton: 'bg-secondary border-0 shadow-none',
                    confirmButton: 'bg-danger border-0 shadow-none',
                },
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-user-form-' + userId).submit();
                }
            });
        }
    </script>
@endpush
