<nav class="navbar">
    <div class="container-fluid">
        <div class="gap-3 navbar-brand d-flex align-items-center">
            <i class='mt-1 bx bx-menu text-light d-md-none fs-1' data-bs-toggle="offcanvas"
                data-bs-target="#mobileNav" aria-controls="mobileNav"></i>
            <span class="py-0 my-0 text-light fw-semibold">{{ $navTitle }}</span>
        </div>
        <ul class="flex-row gap-4 navbar-nav me-2 me-md-3 d-flex align-items-center" id="dropdown">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center text-light" href="#"
                    id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="profile-image">
                        @if (!empty(Auth::user()->avatar))
                            <img class="img" src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}">
                        @else
                            <img class="img"
                                src="https://ui-avatars.com/api/?background=random&name={{ urlencode(Auth::user()->name) }}">
                        @endif
                    </div>
                    <span class="text-light nav-username">&nbsp;{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end position-absolute" aria-labelledby="navbarDropdownMenuLink">
                    <li>
                        <a class="gap-2 dropdown-item d-flex align-items-center" href="{{ route('profile.index') }}">
                            <i class='bx bx-user'></i>
                            Profile
                        </a>
                    </li>
                    <li>
                        <hr class="py-0 my-1 dropdown-divider">
                    </li>
                    <li>
                        <a id="logout-confirmaton" class="gap-2 dropdown-item d-flex align-items-center"
                            href="{{ route('logout') }}" onclick="event.preventDefault(); logout();">
                            <i class='bx bx-log-in'></i>
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileNav" aria-labelledby="mobileNavLabel">
    <div class="offcanvas-header">
        <div class="d-flex align-items-center">
            <a href="{{ route('dashboard.index') }}">
                <img src="{{ url('/assets/img/logo.png') }}" alt="logo" style="width: 40px;"
                    class="logo" id="logo">
            </a>
            <span class="nav-name-brand ms-2 text-light fw-semibold" id="navNameBrand">KKN Desa Kutabawa</span>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <hr class="py-0 my-0 border-light">
    <div class="px-0 mx-0 offcanvas-body">
        <ul class="list-unstyled">
            @if (Auth::user()->roles == 'admin')
                <li class="{{ $active == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('dashboard.index') }}" class="gap-2 d-flex align-items-center">
                        <i class='bx bxs-home fs-4'></i>
                        <span class="py-0 my-0">Dashboard</span>
                    </a>
                </li>
            @endif
            <li class="{{ $active == 'my profile' ? 'active' : '' }}">
                <a href="{{ route('profile.index') }}" class="gap-2 d-flex align-items-center">
                    <i class='bx bxs-user fs-4'></i>
                    <span class="py-0 my-0">My Profile</span>
                </a>
            </li>
            <li class="{{ $active == 'articles' ? 'active' : '' }}">
                <a href="#" class="gap-2 d-flex align-items-center">
                    <i class='bx bxs-news fs-4'></i>
                    <span class="py-0 my-0">Articles</span>
                </a>
            </li>
            @if (Auth::user()->roles == 'admin')
                <li class="{{ $active == 'users' ? 'active' : '' }}">
                    <a href="{{ route('user.index') }}" class="gap-2 d-flex align-items-center">
                        <i class='bx bxs-group fs-4'></i>
                        <span class="py-0 my-0">Users</span>
                    </a>
                </li>
                <li class="{{ $active == 'contents' ? 'active' : '' }}">
                    <a href="#" class="gap-2 d-flex align-items-center">
                        <i class='bx bxs-layout fs-4'></i>
                        <span class="py-0 my-0">Contents</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>


@push('scripts')
    <script>
        function logout() {
            Swal.fire({
                icon: 'question',
                title: 'Anda Yakin?',
                text: 'Apakah Anda yakin ingin logout?',
                showCancelButton: true,
                confirmButtonText: 'Logout',
                customClass: {
                    popup: 'sw-popup',
                    title: 'sw-title',
                    htmlContainer: 'sw-text',
                    icon: 'sw-icon',
                    closeButton: 'bg-secondary border-0 shadow-none',
                    confirmButton: 'bg-danger border-0 shadow-none',
                },
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
@endpush
