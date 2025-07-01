<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ url('assets/img/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('assets/vendors/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ url('assets/css/auth.css') }}">
    <title>{{ $title }}</title>

    <!-- PWA  -->
    <meta name="theme-color" content="#061e34"/>
    <link rel="apple-touch-icon" href="{{ asset('assets/img/logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
</head>

<body>
    <div class="d-flex justify-content-end">
        @include('components.toast')
    </div>
    <div class="px-0 mx-0 d-flex justify-content-center w-100">
        @yield('content')
    </div>

    <script src="{{ url('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/auth.js') }}"></script>
    @stack('scripts')
</body>

</html>
