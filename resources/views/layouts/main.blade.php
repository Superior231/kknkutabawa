<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('components.meta')
    @include('components.style')
</head>

<body data-bs-spy="scroll" data-bs-target="#navbarNav1" data-bs-offset="70" tabindex="0">
    <div class="body">
        @yield('content')
    </div>
    <div class="back-to-top">
        <a class="icon-back-to-top" href="#"><i class='bx bxs-chevron-up fs-2'></i></a>
    </div>
    @include('components.footer')
    @include('components.script')
</body>

</html>
