<nav id="sidebarMenu" class="col-nav ">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products') }}">
                    <span data-feather="shopping-bag" class="icon"></span>
                    Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('orders.index') }}">
                    <span data-feather="shopping-cart" class="icon"></span>
                    Orders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="users" class="icon"></span>
                    Customers-User
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.deliveries') }}">
                    <span data-feather="truck" class="icon"></span>
                    Delivery
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.cancellations') }}">
                    <span data-feather="x-circle" class="icon"></span>
                    Cancelation
                </a>
            </li>
        </ul>
        {{-- sign out --}}
        <div class="sign-out">
            <span data-feather="log-out" class="icon"></span>
            {{-- form logout --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="link">Sign out</button>
            </form>
        </div>
    </div>
</nav>

{{-- side nav --}}
