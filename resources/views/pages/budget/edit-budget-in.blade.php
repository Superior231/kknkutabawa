@extends('layouts.dashboard')

@push('styles')
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

        <form action="{{ route('budget.update', $budget->id) }}" method="POST" class="gap-3 d-flex flex-column" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->id }}">

            <!-- Assets -->
            <div class="card">
                <div class="p-3 card-body p-lg-4">
                    <h5 class="card-title">Assets</h5>
                    <hr class="bg-secondary">
                    <div class="user d-flex align-items-center justify-content-center">
                        <div class="rounded">
                            <img src="{{ $budget->image ? asset('storage/budgets/'.$budget->image) : asset('assets/img/thumbnail.png') }}" alt="thumbnail" id="image-preview" width="100%">
                        </div>
                    </div>
                    <div class="my-3">
                        <label for="image-input">Upload bukti</label>
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
                        <label for="name" class="form-label">Nama<strong class="text-danger">*</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1" style="width: 45px">
                                <i class="bx bx-box"></i>
                            </span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name', $budget->name) }}" required>
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
                                id="date" name="date" value="{{ old('date', $budget->date) }}" required>
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-2">
                        <label for="price_in" class="form-label">Jumlah uang masuk<strong class="text-danger">*</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1" style="width: 45px;">Rp.</span>
                            <input type="text" class="form-control @error('price_in') is-invalid @enderror"
                                id="price_in" name="price_in" value="{{ number_format($budget->price_in, 0, ',', '.') }}"
                                oninput="formatNumber(this)" required>
                            @error('price_in')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div id="editor-container">
                            <label for="description" class="text-dark">Deskripsi</label>
                            <textarea name="description" style="height: 150px;" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $budget->description) }}</textarea>
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
@endpush

