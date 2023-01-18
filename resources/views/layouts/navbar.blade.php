    <header>
        <input type="checkbox" id="chk1">
        <div class="logo">
            <h1>Dominion</h1>
        </div>
        <div class="search-box">
            <form action="">
                <input type="text" name="search" id="srch" placeholder="Search product">
                <button type="submit"><i class="fa fa-search"></i class></button>
            </form>
        </div>

        <button class="button-1" role="button">Sign In</button>
        <br><br><br>
        <button class="button-2" role="button">Sign Up</button>
    </header>
    <br>
    <br>
    <br>
    <hr>
    <header>
        <div class="isi">
            <ul>
                <li><a href="#">Balls & Shuttlecocks</a></li>
                <li><a href="#">Shoes & Sneakers</a></li>
                <li><a href="#">Jersey & T-Shirt</a></li>
                <li><a href="#">Gloves</a></li>
                <li><a href="#">Stick</a></li>
                <li><a href="#">Racquets</a></li>
            </ul>
        </div>
    </header>



    {{-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      @can('isAdmin')
        <a href="{{ route('dashboard') }}" class="btn btn-outline-success">Admin</a>

      @endcan
      {{-- jika sudah login tampilkan logout, jika belum tampilkan login --}}
    {{-- @if (Auth::check())
            <a href="{{ route('logout') }}" class="btn btn-outline-success">Logout</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-success">Login</a>
        @endif

      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav> --}}
