<nav
    class="navbar navbar-expand-lg navbar-light navbar-store fixed-top"
    data-aos="fade-down"
>
    <div class="container-fluid">
        <button
            class="btn btn-primary d-md-none mr-auto mr-2"
            id="menu-toggle"
        >
            Menu
        </button>
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div
            class="collapse navbar-collapse"
            id="navbarSupportedContent"
        >
            <!-- Desktop Menu -->
            <ul class="navbar-nav d-none d-lg-flex ml-auto">
                <li class="nav-item dropdown">
                    <a
                        href="#"
                        class="nav-link"
                        id="navbarDropdown"
                        roles="button"
                        data-toggle="dropdown"
                    >
                        <img
                            src="{{ Storage::url(Auth::user()->avatar) }}"
                            alt="Profile Picture"
                            class="rounded-circle mr-2 profile-picture"
                        />
                        Hi, {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu">
                        @if(Auth::user()->roles == 'Admin' && Auth::user()->staff_status == 1)
                            <a
                                href="{{ route('admin-dashboard') }}"
                                class="dropdown-item"
                                >Dashboard Admin</a
                            >
                        @endif
                        <a
                            href="{{ route('home') }}"
                            class="dropdown-item"
                            >Dashboard Home</a
                        >
                        <a
                            href="{{ route('account.index') }}"
                            class="dropdown-item"
                            >Akun Saya</a
                        >
                        <div class="dropdown-divider"></div>
                        <a
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="dropdown-item text-danger"
                            >Keluar</a
                        >
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav d-block d-lg-none">
                <li class="nav-item">
                    @if (Auth::user()->roles == 'Admin' && Auth::user()->staff_status == 1)
                        <a href="{{ route('admin-dashboard') }}" class="nav-link">
                            Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('account.index') }}" class="nav-link">
                            Hi, {{ Auth::user()->name }}
                        </a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>