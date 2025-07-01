<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('components.style-dashboard')
</head>

<body>
    @include('components.sidebar')
    @include('components.navbar2')
    @include('components.toast')
    <div class="px-3 pb-5 dashboard px-lg-3">
        @yield('content')
    </div>
    <script src="{{ url('/assets/js/dashboard.js') }}"></script>
    @include('components.script')
</body>

</html>
