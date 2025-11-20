<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #001f3f;">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('landingpage') }}">
            <strong>Dominion</strong>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('landingpage') ? 'active' : '' }}"
                        href="{{ route('landingpage') }}">
                        Home
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('history') ? 'active' : '' }}" href="{{ route('history') }}">
                            My Orders
                        </a>
                    </li>
                @endauth
            </ul>

            <!-- Search Form -->
            <form class="d-flex me-3" role="search" style="width: 300px;" action="{{ route('search') }}"
                method="GET">
                <input class="form-control me-2" type="search" placeholder="Search products..." aria-label="Search"
                    name="q" required>
                <button class="btn btn-outline-light" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            <!-- User Actions -->
            <div class="d-flex align-items-center">
                @auth
                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-light me-2 position-relative">
                        <i class="bi bi-cart3"></i>
                        @if (Auth::user()->carts()->count() > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ Auth::user()->carts()->sum('quantity') }}
                            </span>
                        @endif
                    </a>

                    <!-- Admin Link -->
                    @can('isAdmin')
                        <a href="{{ route('admin.index') }}" class="btn btn-outline-light me-2">
                            <i class="bi bi-gear-fill me-1"></i>Admin
                        </a>
                    @endcan

                    <!-- User Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.index') }}">
                                    <i class="bi bi-person me-2"></i>Profile
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light me-2">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-light">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
