<nav class="p-3 sidebar d-none d-md-flex flex-column" style="width: 250px; min-height: 100vh;">
    <header class="d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard.index') }}" class="d-flex align-items-center text-decoration-none">
            <img src="{{ url('/assets/img/logo.png') }}" alt="logo" style="width: 50px;" class="logo" id="logo">
            <span class="nav-name-brand ms-2 text-light fw-semibold" id="navNameBrand">KKN Desa Kutabawa</span>
        </a>
        <i class='bx bx-chevron-left toggle text-light' id="sidebarToggle" style="cursor: pointer;"></i>
    </header>

    <div class="mt-2 menu-bar">
        <ul class="menu-links">
            <li>
                <a href="{{ route('home') }}"
                    class="side-link {{ $active === 'home' ? 'active' : '' }}" data-bs-toggle="tooltip"
                    data-bs-placement="right" data-bs-title="Halaman utama">
                    <i class='bx bx-arrow-back icon'></i>
                    <span class="px-0 mx-0 nav-text">Halaman utama</span>
                </a>
            </li>
            <hr class="py-0 my-0 border-secondary">
        </ul>
        
        <ul class="menu-links">
            <li>
                <a href="{{ route('dashboard.index') }}"
                    class="side-link {{ $active === 'dashboard' ? 'active' : '' }}" data-bs-toggle="tooltip"
                    data-bs-placement="right" data-bs-title="Dashboard">
                    <i class='bx bxs-home icon'></i>
                    <span class="px-0 mx-0 nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('profile.index') }}"
                    class="side-link {{ $active === 'my profile' ? 'active' : '' }}" data-bs-toggle="tooltip"
                    data-bs-placement="right" data-bs-title="My profile">
                    <i class='bx bxs-user icon'></i>
                    <span class="px-0 mx-0 nav-text">My profile</span>
                </a>
            </li>
            @if (Auth::user()->roles == 'admin')
                <li>
                    <a href="{{ route('user.index') }}"
                        class="side-link {{ $active === 'users' ? 'active' : '' }}" data-bs-toggle="tooltip"
                        data-bs-placement="right" data-bs-title="Users">
                        <i class='bx bxs-group icon'></i>
                        <span class="px-0 mx-0 nav-text">Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('content.index') }}"
                        class="side-link {{ $active === 'contents' ? 'active' : '' }}" data-bs-toggle="tooltip"
                        data-bs-placement="right" data-bs-title="Contents">
                        <i class='bx bxs-layout icon'></i>
                        <span class="px-0 mx-0 nav-text">Contents</span>
                    </a>
                </li>
            @endif
            <li>
                <a href="{{ route('project.index') }}"
                    class="side-link {{ $active === 'projects' ? 'active' : '' }}" data-bs-toggle="tooltip"
                    data-bs-placement="right" data-bs-title="Projects">
                    <i class='bx bxs-news icon'></i>
                    <span class="px-0 mx-0 nav-text">Projects</span>
                </a>
            </li>
            <li>
                <a href="{{ route('budget.index') }}"
                    class="side-link {{ $active === 'budget' ? 'active' : '' }}" data-bs-toggle="tooltip"
                    data-bs-placement="right" data-bs-title="Anggaran">
                    <i class='bx bxs-dollar-circle icon'></i>
                    <span class="px-0 mx-0 nav-text">Anggaran</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
