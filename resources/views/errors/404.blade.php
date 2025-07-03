<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ url('/assets/img/logo.png') }}" type="image/x-icon">
    @include('components.style', ['title' => 'Error 404: Page Not Found'])
    <style>
        .error-img {
            width: 400px;
        }
        .back:hover span {
            text-decoration: underline !important;
        }
        @media (max-width: 460px) {
            .error-img {
                width: 300px;
            }
        }
    </style>
</head>
<body style="background-color: #fffefe !important;">
    <nav class="px-2 py-3 container-fluid px-md-5">
        <a href="{{ route('home') }}" class="gap-1 back d-flex align-items-center text-decoration-none text-dark fw-bold">
            <i class="bx bx-chevron-left fs-3 fw-bold"></i>
            <span>Back to Home</span>
        </a>
    </nav>
    <div class="gap-1 position-absolute top-50 start-50 translate-middle d-flex flex-column align-items-center justify-content-center">
        <img src="{{ url('assets/img/404.gif') }}" class="error-img" alt="Error gif">
        <h3 class="fw-bold">Page Not Found</h3>
    </div>
    @include('components.script')
</body>
</html>
