<nav class="p-3 sidebar d-none d-md-flex flex-column" style="width: 250px; min-height: 100vh;">
    <header class="d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard.index') }}" class="d-flex align-items-center text-decoration-none">
            <img src="{{ url('/assets/img/logo.png') }}" alt="logo" style="width: 50px;" class="logo" id="logo">
            <span class="nav-name-brand ms-2 text-light fw-semibold" id="navNameBrand">KKN Desa Kutabawa</span>
        </a>
        <i class='bx bx-chevron-left toggle text-light' id="sidebarToggle" style="cursor: pointer;"></i>
    </header>

    <div class="mt-4 menu-bar">
        <ul class="menu-links">
            @if (Auth::user()->roles == 'admin')
                <li>
                    <a href="{{ route('dashboard.index') }}"
                        class="side-link {{ $active === 'dashboard' ? 'active' : '' }}" data-bs-toggle="tooltip"
                        data-bs-placement="right" data-bs-title="Dashboard">
                        <i class='bx bxs-home icon'></i>
                        <span class="px-0 mx-0 nav-text">Dashboard</span>
                    </a>
                </li>
            @endif
            <li>
                <a href="{{ route('profile.index') }}"
                    class="side-link {{ $active === 'my profile' ? 'active' : '' }}" data-bs-toggle="tooltip"
                    data-bs-placement="right" data-bs-title="My Profile">
                    <i class='bx bxs-user icon'></i>
                    <span class="px-0 mx-0 nav-text">My Profile</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="side-link {{ $active === 'articles' ? 'active' : '' }}" data-bs-toggle="tooltip"
                    data-bs-placement="right" data-bs-title="Articles">
                    <i class='bx bxs-news icon'></i>
                    <span class="px-0 mx-0 nav-text">Articles</span>
                </a>
            </li>
            @if (Auth::user()->roles == 'admin')
                <li>
                    <a href="{{ route('users.index') }}"
                        class="side-link {{ $active === 'users' ? 'active' : '' }}" data-bs-toggle="tooltip"
                        data-bs-placement="right" data-bs-title="Users">
                        <i class='bx bxs-group icon'></i>
                        <span class="px-0 mx-0 nav-text">Users</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="side-link {{ $active === 'contents' ? 'active' : '' }}" data-bs-toggle="tooltip"
                        data-bs-placement="right" data-bs-title="Contents">
                        <i class='bx bxs-layout icon'></i>
                        <span class="px-0 mx-0 nav-text">Contents</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>
