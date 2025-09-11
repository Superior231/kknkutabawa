@extends('layouts.dashboard')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        .row.dt-row {
            overflow-x: auto !important;
        }
    </style>
@endpush

@section('content')
    <section id="project">
        @if (Auth::user()->roles == 'admin')
            <div class="p-4 mb-3 card">
                <div class="actions d-flex justify-content-between align-items-center">
                    <h4 class="py-0 my-0 fw-semibold">Semua Kategori</h4>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add-category-modal" class="gap-1 px-4 py-2 rounded-20 btn btn-primary d-flex align-items-center">
                        <i class='bx bx-plus'></i>
                        Tambah
                    </a>
                </div>
                <hr>
                <table class="table table-striped table-hover" id="categoryTable">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Name</th>
                            <th>Updated_at</th>
                            <th>Created_at</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $index => $category)
                            <tr class="align-middle">
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>
                                    <div style="min-width: 250px;">
                                        {{ $category->name }}
                                    </div>
                                </td>
                                <td>{{ Carbon\Carbon::parse($category->updated_at)->translatedFormat('d F Y, H:i') }} WIB</td>
                                <td>{{ Carbon\Carbon::parse($category->created_at)->translatedFormat('d F Y, H:i') }} WIB</td>
                                <td>
                                    <div class="gap-2 actions d-flex align-items-center justify-content-center pe-3">
                                        <a style="cursor: pointer;" onclick="editCategory('{{ $category->id }}', '{{ $category->name }}')" data-bs-toggle="modal" data-bs-target="#edit-category-modal"
                                            class="p-2 rounded btn btn-primary d-flex align-items-center justify-content-center">
                                            <i class='p-0 m-0 bx bxs-pencil'></i>
                                        </a>
                                        <form id="delete-category-form-{{ $category->id }}" action="{{ route('category.destroy', $category->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            
                                            <button type="button" style="cursor: pointer;"
                                                class="p-2 rounded btn btn-danger d-flex align-items-center justify-content-center" onclick="confirmDeleteCategory({{ $category->id }})">
                                                <i class='p-0 m-0 bx bxs-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Projects -->
        <div class="p-4 card">
            <div class="actions d-flex justify-content-between align-items-center">
                <h4 class="py-0 my-0 fw-semibold">Semua Project</h4>
                <a href="{{ route('project.create') }}" class="gap-1 px-4 py-2 rounded-20 btn btn-primary d-flex align-items-center">
                    <i class='bx bx-plus'></i>
                    Tambah
                </a>
            </div>
            <hr>
            <table class="table table-striped table-hover" id="projectTable">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Updated_at</th>
                        <th>Created_at</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $index => $project)
                        <tr class="align-middle">
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                <div class="title" style="min-width: 250px;">
                                    {{ $project->title }}
                                </div>
                            </td>
                            <td>
                                <div class="mb-0 category text-color fs-7">
                                    @foreach (explode(', ', $project->category) as $category)
                                        @php
                                            $category = trim($category); // remove leading/trailing spaces
                                            $badgeClass = match ($category) {
                                                'Ekonomi' => 'bg-ekonomi',
                                                'Jati Diri' => 'bg-jatidiri',
                                                'Kesehatan' => 'bg-kesehatan',
                                                'Lingkungan' => 'bg-lingkungan',
                                                'Pendidikan' => 'bg-pendidikan',
                                                'Unggulan' => 'bg-unggulan',
                                                default => 'bg-default',
                                            };
                                    
                                            $iconClass = match ($category) {
                                                'Ekonomi' => 'fa-dollar-sign',
                                                'Jati Diri' => 'fa-people-group',
                                                'Kesehatan' => 'fa-heart-pulse',
                                                'Lingkungan' => 'fa-leaf',
                                                'Pendidikan' => 'fa-graduation-cap',
                                                'Unggulan' => 'fa-thumbs-up',
                                                default => 'fa-circle-question',
                                            };
                                        @endphp
                                        
                                        <p class="badge {{ $badgeClass }}">
                                            <i class="fa-solid {{ $iconClass }}"></i> {{ $category }}
                                        </p>
                                    @endforeach
                                </div>
                            </td>
                            <td>{{ Carbon\Carbon::parse($project->updated_at)->translatedFormat('d F Y, H:i') }} WIB</td>
                            <td>{{ Carbon\Carbon::parse($project->created_at)->translatedFormat('d F Y, H:i') }} WIB</td>
                            <td>
                                <div class="gap-2 actions d-flex align-items-center justify-content-center pe-3">
                                    <a href="{{ route('project.edit', $project->slug) }}" style="cursor: pointer;"
                                        class="p-2 rounded btn btn-primary d-flex align-items-center justify-content-center">
                                        <i class='p-0 m-0 bx bxs-pencil'></i>
                                    </a>
    
                                    @if (Auth::user()->id === $project->user_id || Auth::user()->roles === 'admin')
                                        <form id="delete-project-form-{{ $project->id }}" action="{{ route('project.destroy', $project->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            
                                            <button type="button" style="cursor: pointer;"
                                                class="p-2 rounded btn btn-danger d-flex align-items-center justify-content-center" onclick="confirmDeleteProject({{ $project->id }})">
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
    </section>


    <!-- Add Category Modal -->
    <div class="modal fade" id="add-category-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('category.store') }}" method="POST">
                @csrf

                <div class="modal-content">
                    <div class="pb-0 mb-0 border-0 modal-header d-flex align-items-center justify-content-between">
                        <h5 class="modal-title" id="add-category-label">Tambah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <hr class="mb-0">
                    <div class="modal-body">
                        <label for="name" class="mb-1">Nama kategori</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan nama kategorinya" required>
                    </div>
                    <div class="border-0 modal-footer">
                        <button type="submit" class="px-4 btn btn-primary rounded-pill" id="add-category-btn">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="edit-category-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="pb-0 mb-0 border-0 modal-header d-flex align-items-center justify-content-between">
                    <h3 class="modal-title" id="edit-category-label">Edit Kategori</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form id="edit-category-form" method="POST">
                    @csrf @method('PUT')

                    <div class="modal-body">
                        <label for="edit-name" class="mb-1">Nama kategori</label>
                        <input type="text" name="name" class="form-control" id="edit-name" placeholder="Masukkan nama kategorinya" required>
                    </div>
                    <div class="border-0 modal-footer">
                        <button type="submit" id="edit-category-btn" class="px-4 rounded-pill btn btn-primary">Simpan</button>
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

    <script>
        $(document).ready(function() {
            $('#projectTable').DataTable({
                "language": {
                    "searchPlaceholder": "Search..."
                }
            });

            $('#categoryTable').DataTable({
                "language": {
                    "searchPlaceholder": "Search..."
                }
            });
        });

        function editCategory(id, name) {
            $('#edit-name').val(name);

            $('#edit-category-form').attr('action', "{{ route('category.update', '') }}" + '/' + id);
            $('#edit-category-modal').modal('show');
        }

        function confirmDeleteCategory(categoryId) {
            Swal.fire({
                icon: 'question',
                title: 'Anda Yakin?',
                text: 'Apakah Anda yakin ingin menghapus kategori ini?',
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
                    document.getElementById('delete-category-form-' + categoryId).submit();
                }
            });
        }

        function confirmDeleteProject(projectId) {
            Swal.fire({
                icon: 'question',
                title: 'Anda Yakin?',
                text: 'Apakah Anda yakin ingin menghapus project ini?',
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
                    document.getElementById('delete-project-form-' + projectId).submit();
                }
            });
        }
    </script>
@endpush
