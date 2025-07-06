<link rel="icon" href="{{ url('assets/img/logo.png') }}" type="image/png">
<link rel="stylesheet" href="{{ url('assets/vendors/bootstrap/css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ url('assets/vendors/boxicons/css/boxicons.min.css') }}">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ url('assets/css/dashboard.css') }}">

<!-- PWA  -->
<meta name="theme-color" content="#061e34"/>
<link rel="apple-touch-icon" href="{{ asset('assets/img/logo.png') }}">
<link rel="manifest" href="{{ asset('/manifest.json') }}">

@stack('styles')

<title>{{ $title }}</title>