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
    <div class="container px-0 px-md-3 px-lg-5">
        <div class="gap-2 mb-4 title d-flex align-items-center">
            <a href="{{ route('budget.index') }}" class="text-dark d-flex align-items-center" title="Back">
                <i class='bx bx-arrow-back fs-2'></i>
            </a>
            <h4 class="py-0 my-0 text-dark fw-bold">{{ $navTitle }}</h4>
        </div>

        <form action="{{ route('budget.store') }}" method="POST" class="gap-3 d-flex flex-column" enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->id }}">

            <!-- Assets -->
            <div class="card">
                <div class="p-3 card-body p-lg-4">
                    <h5 class="card-title">Assets</h5>
                    <hr class="bg-secondary">
                    <div class="user d-flex align-items-center justify-content-center">
                        <div class="rounded thumbnail-previews">
                            <img src="{{ asset('assets/img/thumbnail.png') }}" alt="thumbnail" id="image-preview" width="100%">
                        </div>
                    </div>
                    <div class="my-3">
                        <label for="image-input">Upload kwitansi/nota</label>
                        <input type="file" name="image" id="image-input" class="form-control @error('image') is-invalid @enderror"
                            accept=".jpg, .jpeg, .png, .webp">
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Data -->
            <div class="card">
                <div class="p-3 card-body p-lg-4">
                    <h5 class="card-title">Data</h5>
                    <hr class="bg-secondary">
                    <div class="mb-3">
                        <label for="type-select">Type<strong class="text-danger">*</strong></label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type-select" multiple="multiple" name="type[]"
                            style="width: 100%;">
                            @foreach ($types as $type)
                                <option value="{{ $type->name }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="type" id="type-input" value="" required>
                        @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="name" class="form-label">Nama barang<strong class="text-danger">*</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1" style="width: 45px">
                                <i class="bx bx-box"></i>
                            </span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" placeholder="Masukkan nama barang" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-2">
                        <label for="date" class="form-label">Tanggal<strong class="text-danger">*</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1" style="width: 45px">
                                <i class='bx bx-time-five'></i>
                            </span>
                            <input type="date" class="form-control @error('date') is-invalid @enderror"
                                id="date" name="date" required>
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-2">
                        <label for="price_out" class="form-label">Harga satuan<strong class="text-danger">*</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1" style="width: 45px;">Rp.</span>
                            <input type="text" class="form-control @error('price_out') is-invalid @enderror"
                                id="price_out" name="price_out" placeholder="Jika tidak ada masukkan 0"
                                oninput="formatNumber(this)" required>
                            @error('price_out')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-2">
                        <label for="quantity" class="form-label">Quantity<strong class="text-danger">*</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1" style="width: 45px;">
                                <i class='bx bx-bar-chart-alt-2'></i>
                            </span>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                id="quantity" name="quantity" placeholder="Masukkan quantity" required>
                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div id="editor-container">
                            <label for="description" class="text-dark">Deskripsi</label>
                            <textarea name="description" style="height: 150px;" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Kosongkan jika tidak ada">{{ old('description') }}</textarea>
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
                <button class="px-4 py-2 rounded-20 btn btn-primary" type="submit">Tambah</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function formatNumber(input) {
            const value = input.value.replace(/[^\d]/g, '');
            const number = parseFloat(value);

            if (!isNaN(number) && number >= 0) {
                input.value = number.toLocaleString('id-ID');
            } else {
                input.value = '';
            }
        }
    </script>
    <script>
        const selectOptions = {
            tags: true,
            placeholder: 'Select',
            allowClear: true,
            width: '100%',
        };
    
        $('#type-select').select2(selectOptions).on('change', function () {
            const selectedValues = $(this).val();
            $(`#${this.id}-input`).val(selectedValues ? selectedValues.join(', ') : '');
        });
    
        $('form').on('submit', function () {
            $('#type-input').val($('#type-select').val()?.join(', ') ?? '');
        });
    </script>
@endpush
