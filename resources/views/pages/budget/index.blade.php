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
    <div class="gap-3 d-flex flex-column" id="project">
        <div class="row g-3" id="budget-stats">
            <div class="col">
                <div class="card border-success h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="gap-2 d-flex">
                            <div class="p-0 m-0 icon">
                                <i class='p-3 bx bx-down-arrow-alt text-success fs-2'></i>
                            </div>
                            <div class="gap-1 d-flex flex-column justify-content-center align-items-start">
                                <h6 class="py-0 my-0 text-nowrap">Total Pemasukan</h6>
                                <h5 class="py-0 my-0 fw-bold">Rp{{ number_format($total_pemasukan, 0, ',', '.') }}</h5>
                            </div>
                        </div>
                        <a href="{{ route('budget.index') }}#budgetIn" class="p-0 m-0 text-decoration-none text-color">
                            <i class='p-3 bx bx-chevron-right fs-2'></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-danger h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="gap-2 d-flex">
                            <div class="p-0 m-0 icon text-danger">
                                <i class='p-3 bx bx-up-arrow-alt fs-2'></i>
                            </div>
                            <div class="gap-1 d-flex flex-column justify-content-center align-items-start">
                                <h6 class="py-0 my-0 text-nowrap">Total Pengeluaran</h6>
                                <h5 class="py-0 my-0 fw-bold">Rp{{ number_format($total_pengeluaran, 0, ',', '.') }}</h5>
                            </div>
                        </div>
                        <a href="{{ route('budget.index') }}#budgetOut" class="p-0 m-0 text-decoration-none text-color">
                            <i class='p-3 bx bx-chevron-right fs-2'></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-warning h-100">
                    <div class="card-body">
                        <div class="gap-2 d-flex">
                            <div class="p-0 m-0 icon">
                                <i class='p-3 bx bxs-dollar-circle text-warning fs-2'></i>
                            </div>
                            <div class="gap-1 d-flex flex-column justify-content-center align-items-start">
                                <h6 class="py-0 my-0 text-nowrap">Sisa Anggaran</h6>
                                <h5 class="py-0 my-0 fw-bold">Rp{{ number_format($sisa_anggaran, 0, ',', '.') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-4 card">
            <div class="title">
                <h4 class="py-0 my-0 fw-semibold">Cetak Laporan</h4>
            </div>
            <hr>
            <div class="flex gap-1 actions d-grid d-md-flex justify-content-md-center w-100">
                <a href="#" onclick="showOngoingFeatureAlert()" class="gap-1 px-4 py-2 rounded-10 btn btn-success d-flex align-items-center justify-content-center">
                    <i class='bx bx-printer'></i>
                    Print to Excel
                </a>
                <a href="#" onclick="showOngoingFeatureAlert()" class="gap-1 px-4 py-2 rounded-10 btn btn-danger d-flex align-items-center justify-content-center">
                    <i class='bx bx-printer'></i>
                    Print to PDF
                </a>
            </div>
        </div>

        <section class="p-4 card" id="budgetIn">
            <div class="actions d-flex justify-content-between align-items-center">
                <h4 class="py-0 my-0 fw-semibold">Semua Pemasukan</h4>
                @if (Auth::user()->roles == 'admin' || in_array('Bendahara', explode(', ', Auth::user()->jobs)))
                    <a href="{{ route('budgetIn.create') }}" class="gap-1 px-4 py-2 rounded-20 btn btn-primary d-flex align-items-center">
                        <i class='bx bx-plus'></i>
                        Tambah
                    </a>
                @endif
            </div>
            <hr>
            <table class="table table-striped table-hover" id="budgetInTable" style="padding-bottom: 70px;">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Bendahara</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Desc</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($budgets as $budget)
                        @if ($budget->price_in > 0)
                            <tr class="align-middle">
                                <td>
                                    <div class="position-relative d-flex justify-content-center">
                                        <div class="image d-flex justify-content-center"
                                            style="cursor: pointer;" data-bs-toggle="modal"
                                            data-bs-target="#showImageModal"
                                            onclick="showImage('{{ $budget->image }}')">
                                            @if (!empty($budget->image))
                                                <img src="{{ asset('storage/budgets/' . $budget->image) }}"
                                                    alt="thumbnail" class="img-fluid">
                                            @else
                                                <img src="{{ url('assets/img/thumbnail.png') }}" alt="thumbnail"
                                                    class="img-fluid">
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fs-7">
                                        {{ $budget->name }}
                                    </div>
                                </td>
                                <td>
                                    <div class="gap-1 user d-flex align-items-center">
                                        <div class="avatar" style="width: 25px !important; height: 25px !important;">
                                            @if (!empty($budget->user->avatar))
                                                <img class="img" src="{{ asset('storage/avatars/' . $budget->user->avatar) }}">
                                            @else
                                                <img class="img"
                                                    src="https://ui-avatars.com/api/?background=random&name={{ urlencode($budget->user->name) }}">
                                            @endif
                                        </div>
                                        <span class="py-0 my-0 fs-7 username" data-bs-toggle="tooltip" title="{{ $budget->user->name }}">{{ $budget->user->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="fs-7">{{ 'Rp' . number_format($budget->price_in, 0, ',', '.') }}</span>
                                </td>
                                <td data-order="{{ $budget->date }}">
                                    <span class="fs-7">
                                        {{ \Carbon\Carbon::parse($budget->date)->format('d M Y') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="fs-7">
                                        {{ $budget->description }}
                                    </span>
                                </td>
                                <td>
                                    @if (Auth::user()->roles == 'admin' || in_array('Bendahara', explode(', ', Auth::user()->jobs)))
                                        <div class="gap-2 actions d-flex align-items-center justify-content-center pe-3">
                                            <a href="{{ route('budgetIn.edit', $budget->id) }}" style="cursor: pointer;"
                                                class="p-2 rounded btn btn-primary d-flex align-items-center justify-content-center">
                                                <i class='p-0 m-0 bx bxs-pencil'></i>
                                            </a>
            
                                            <form id="delete-budget-form-{{ $budget->id }}" action="{{ route('budget.destroy', $budget->id) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                
                                                <button type="button" style="cursor: pointer;"
                                                    class="p-2 rounded btn btn-danger d-flex align-items-center justify-content-center" onclick="confirmDeleteBudget({{ $budget->id }})">
                                                    <i class='p-0 m-0 bx bxs-trash'></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="w-100">
                        <td colspan="3" class="text-center">
                            <span class="fw-semibold">Jumlah</span>
                        </td>
                        <td colspan="1">
                            <div class="d-flex justify-content-end">
                                <span class="fw-semibold pe-3">Rp
                                    {{ number_format(array_reduce($budgets->toArray(), function ($carry, $item) {
                                        return $carry + ($item['price_in']);
                                    }, 0), 0, ',', '.') }}
                                </span>
                            </div>
                        </td>
                        <td colspan="3"></td>
                    </tr>
                </tfoot>
            </table>
        </section>

        <section class="p-4 card" id="budgetOut">
            <div class="actions d-flex justify-content-between align-items-center">
                <h4 class="py-0 my-0 fw-semibold">Semua Pengeluaran</h4>
                @if (Auth::user()->roles == 'admin' || in_array('Bendahara', explode(', ', Auth::user()->jobs)))
                    <a href="{{ route('budget.create') }}" class="gap-1 px-4 py-2 rounded-20 btn btn-primary d-flex align-items-center">
                        <i class='bx bx-plus'></i>
                        Tambah
                    </a>
                @endif
            </div>
            <hr>
            <table class="table table-striped table-hover" id="budgetOutTable" style="padding-bottom: 70px;">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Bendahara</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Date</th>
                        <th>Desc</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($budgets as $budget)
                        @if ($budget->price_out > 0)
                            <tr class="align-middle">
                                <td>
                                    <div class="position-relative d-flex justify-content-center">
                                        <div class="image d-flex justify-content-center"
                                            style="cursor: pointer;" data-bs-toggle="modal"
                                            data-bs-target="#showImageModal"
                                            onclick="showImage('{{ $budget->image }}')">
                                            @if (!empty($budget->image))
                                                <img src="{{ asset('storage/budgets/' . $budget->image) }}"
                                                    alt="thumbnail" class="img-fluid">
                                            @else
                                                <img src="{{ url('assets/img/thumbnail.png') }}" alt="thumbnail"
                                                    class="img-fluid">
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fs-7">
                                        {{ $budget->name }}
                                    </div>
                                </td>
                                <td>
                                    <div class="gap-1 user d-flex align-items-center">
                                        <div class="avatar" style="width: 25px !important; height: 25px !important;">
                                            @if (!empty($budget->user->avatar))
                                                <img class="img" src="{{ asset('storage/avatars/' . $budget->user->avatar) }}">
                                            @else
                                                <img class="img"
                                                    src="https://ui-avatars.com/api/?background=random&name={{ urlencode($budget->user->name) }}">
                                            @endif
                                        </div>
                                        <span class="py-0 my-0 fs-7 username" data-bs-toggle="tooltip" title="{{ $budget->user->name }}">{{ $budget->user->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="fs-7">
                                        {{ $budget->type }}
                                    </span>
                                </td>
                                <td>
                                    <span class="fs-7">{{ 'Rp' . number_format($budget->price_out, 0, ',', '.') }}</span>
                                </td>
                                <td class="text-center fs-7">{{ $budget->quantity }}</td>
                                <td>
                                    <span class="fs-7">{{ 'Rp' . number_format($budget->price_out * $budget->quantity, 0, ',', '.') }}</span>
                                </td>
                                <td data-order="{{ $budget->date }}">
                                    <span class="fs-7">
                                        {{ \Carbon\Carbon::parse($budget->date)->format('d M Y') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="fs-7">
                                        {{ $budget->description }}
                                    </span>
                                </td>
                                <td>
                                    @if (Auth::user()->roles == 'admin' || in_array('Bendahara', explode(', ', Auth::user()->jobs)))
                                        <div class="gap-2 actions d-flex align-items-center justify-content-center pe-3">
                                            <a href="{{ route('budget.edit', $budget->id) }}" style="cursor: pointer;"
                                                class="p-2 rounded btn btn-primary d-flex align-items-center justify-content-center">
                                                <i class='p-0 m-0 bx bxs-pencil'></i>
                                            </a>
            
                                            <form id="delete-budget-form-{{ $budget->id }}" action="{{ route('budget.destroy', $budget->id) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                
                                                <button type="button" style="cursor: pointer;"
                                                    class="p-2 rounded btn btn-danger d-flex align-items-center justify-content-center" onclick="confirmDeleteBudget({{ $budget->id }})">
                                                    <i class='p-0 m-0 bx bxs-trash'></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="w-100">
                        <td colspan="5" class="text-center">
                            <span class="fw-semibold">Jumlah</span>
                        </td>
                        <td colspan="2">
                            <div class="d-flex justify-content-end">
                                <span class="fw-semibold pe-3">Rp
                                    {{ number_format(array_reduce($budgets->toArray(), function ($carry, $item) {
                                        return $carry + ($item['price_out'] * $item['quantity']);
                                    }, 0), 0, ',', '.') }}
                                </span>
                            </div>
                        </td>
                        <td colspan="3"></td>
                    </tr>
                </tfoot>
            </table>
        </section>
    </div>

    <!-- Show Image Modal -->
    <div class="modal fade" id="showImageModal" tabindex="-1" aria-labelledby="showImageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-fullscreen modal-dialog-centered">
            <div class="bg-transparent modal-content">
                <div class="border-0 modal-header">
                    <a id="downloadImageBtn" href="#" download class="btn btn-light me-auto">Download</a>
                    <div class="close d-flex justify-content-end w-100" data-bs-dismiss="modal" aria-label="Close"
                        style="cursor: pointer;">
                        <i class='bx bx-x text-light fs-1'></i>
                    </div>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <div class="item-image" style="max-width: 100vw;">
                        <img src="" alt="image" id="showImage" style="width: 100%;">
                    </div>
                </div>
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
            $('#budgetInTable').DataTable({
                "language": {
                    "searchPlaceholder": "Search..."
                },
                "pageLength": 100
            });
            $('#budgetOutTable').DataTable({
                "language": {
                    "searchPlaceholder": "Search..."
                },
                "pageLength": 100
            });
        });

        function showImage(image) {
            let imageUrl = image ? '{{ asset('storage/budgets') }}/' + image :
                '{{ url('assets/img/thumbnail.png') }}';
            $('#showImage').attr('src', imageUrl);
            $('#downloadImageBtn').attr('href', imageUrl);
        }

        function confirmDeleteBudget(budgetId) {
            Swal.fire({
                icon: 'question',
                title: 'Anda Yakin?',
                text: 'Apakah Anda yakin ingin menghapus anggaran ini?',
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
                    document.getElementById('delete-budget-form-' + budgetId).submit();
                }
            });
        }
    </script>

    <script>
        function showOngoingFeatureAlert() {
            Swal.fire({
                icon: 'info',
                title: 'Fitur ini masih dalam pengembangan',
                text: 'Mohon maaf, fitur ini masih dalam pengembangan dan belum tersedia untuk digunakan. Kami akan segera menginformasikan Anda ketika fitur ini sudah siap digunakan.',
                confirmButtonText: 'Ok',
                customClass: {
                    popup: 'sw-popup',
                    title: 'sw-title',
                    htmlContainer: 'sw-text',
                    icon: 'sw-icon',
                    closeButton: 'bg-secondary border-0 shadow-none',
                    confirmButton: 'bg-primary border-0 shadow-none',
                }
            });
        }
    </script>
@endpush
