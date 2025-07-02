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
    @include('components.script')
</body>

</html>
