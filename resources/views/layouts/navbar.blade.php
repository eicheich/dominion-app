    {{-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
                <a href="{{ route('cart.index') }}" class="btn btn-outline-success">Cart</a>
                @can('isAdmin')
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-success">Admin</a>
                @endcan
                @if (Auth::check())
                    <a href="{{ route('profile.index') }}" class="btn btn-outline-danger">Profile</a>
                    <a href="{{ route('logout') }}" class="btn btn-outline-success">Logout</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-success">Register</a>
                @endif
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav> --}}

    <header class="navbar">
        <a href="#" class="navbar-logo">Dominion</a>
        <div class="navbar-mid">
            <div class="navbar-search">
                <input type="text" placeholder="Search">
                <a href="#">
                    <i data-feather="search"></i>
                </a>
            </div>
        </div>
        <div class="navbar-right">
            <a href="{{ route('cart.index') }}" id="menu"><i data-feather="shopping-cart"></i></a>
            <a href="{{ route('profile.index') }}" id="menu"><i data-feather="user"></i></a>
            @can('isAdmin')
                 <a href="{{ route('dashboard') }}" id="menu"><i data-feather="tool"></i></a>
            @endcan
        </div>
    </header>
