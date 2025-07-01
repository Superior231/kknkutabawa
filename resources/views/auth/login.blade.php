@extends('layouts.auth', ['title' => 'Login - KKN Desa Kutabawa'])

@section('content')
    <div class="row w-100" style="height: 100svh;">
        <div class="col col-12 col-md-6 col-lg-7 d-flex flex-column justify-content-center" id="hero"></div>
        <div class="col col-12 col-sm-12 col-md-6 col-lg-5 d-flex flex-column justify-content-center">
            <a href="{{ route('home') }}" class="p-3 text-center shadow position-absolute bg-light rounded-4 text-daecoration-none text-color d-flex align-items-center" style="top: 20px; right: 20px;">
                <i class="fa-solid fa-house text-color"></i>
            </a>
            <div class="d-flex flex-column justify-content-between h-100">
                <div class="container d-flex flex-column justify-content-center px-auto px-md-5 h-100">
                    <div class="d-flex flex-column align-items-center">
                        <div class="gap-3 mb-4 d-flex flex-column align-items-center d-none" id="logo-mobile">
                            <img src="{{ url('assets/img/logo.png') }}" alt="Logo" style="width: 100px; height: auto;">
                        </div>
                        <h3 class="fw-bold">Sign in</h3>
                        <p class="text-center">Masuk Aplikasi KKN Desa Kutabawa</p>
                    </div>
    
                    <form method="POST" action="{{ route('login') }}" class="mt-4 auth">
                        @csrf
    
                        <div class="mb-3 content">
                            <div class="pass-logo">
                                <i class='bx bx-user'></i>
                            </div>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Name"
                                value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
    
                        <div class="mb-3 content">
                            <div class="pass-logo">
                                <i class='bx bx-lock-alt'></i>
                            </div>
                            <div class="d-flex align-items-center position-relative">
                                <input type="password" id="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" style="padding-right: 45px;"
                                    placeholder="Password" required>
                                <div class="showPass d-flex align-items-center justify-content-center position-absolute end-0 h-100"
                                    id="showPass" style="cursor: pointer; width: 50px; border-radius: 0px 10px 10px 0px;"
                                    onclick="showPass()">
                                    <i class="fa-regular fa-eye-slash"></i>
                                </div>
                            </div>
    
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class="mt-4 btn btn-primary d-block fw-semibold w-100" type="submit">Login</button>
                    </form>
                </div>
                <div class="py-5 footer d-flex justify-content-center" style="height: 20px">
                    <small class="text-secondary">Copyright &copy;2025, All Rights Reserved.</small>
                </div>
            </div>
        </div>
    </div>
@endsection
