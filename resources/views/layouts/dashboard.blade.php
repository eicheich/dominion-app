<!-- Admin Sidebar -->
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
    <div class="position-sticky pt-0">
        <!-- Brand Logo -->
        <div class="sidebar-brand d-flex align-items-center justify-content-center py-4">
            <div class="sidebar-brand-text">
                <span class="fw-bold text-white fs-4">Dominion</span><br>
                <small class="text-light opacity-75">Admin Panel</small>
            </div>
        </div>

        <hr class="sidebar-divider my-0">

        <ul class="nav flex-column px-2">
            <!-- Dashboard -->
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}"
                    href="{{ route('admin.index') }}">
                    <i class="bi bi-speedometer2 me-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Products Section -->
            <li class="nav-item mb-1">
                <div class="nav-section-header">
                    <h6 class="sidebar-heading text-uppercase">
                        <i class="bi bi-box me-2"></i>Products
                    </h6>
                </div>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}"
                    href="{{ route('products.index') }}">
                    <i class="bi bi-grid me-3"></i>
                    <span>All Products</span>
                    <span class="badge bg-primary ms-auto">{{ \App\Models\Product::count() }}</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->routeIs('products.create') ? 'active' : '' }}"
                    href="{{ route('products.create') }}">
                    <i class="bi bi-plus-circle me-3"></i>
                    <span>Add Product</span>
                </a>
            </li>

            <!-- Orders Section -->
            <li class="nav-item mb-1">
                <div class="nav-section-header">
                    <h6 class="sidebar-heading text-uppercase">
                        <i class="bi bi-cart me-2"></i>Orders
                    </h6>
                </div>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->routeIs('orders*') ? 'active' : '' }}"
                    href="{{ route('orders.index') }}">
                    <i class="bi bi-cart-check me-3"></i>
                    <span>All Orders</span>
                    <span class="badge bg-success ms-auto">{{ \App\Models\Order::count() }}</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->routeIs('admin.deliveries') ? 'active' : '' }}"
                    href="{{ route('admin.deliveries') }}">
                    <i class="bi bi-truck me-3"></i>
                    <span>Deliveries</span>
                </a>
            </li>

            <!-- Users Section -->
            <li class="nav-item mb-1">
                <div class="nav-section-header">
                    <h6 class="sidebar-heading text-uppercase">
                        <i class="bi bi-people me-2"></i>Users
                    </h6>
                </div>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}"
                    href="{{ route('admin.users.index') }}">
                    <i class="bi bi-person-lines-fill me-3"></i>
                    <span>All Users</span>
                    <span class="badge bg-info ms-auto">{{ \App\Models\User::count() }}</span>
                </a>
            </li>

            <!-- Reports Section -->
            <li class="nav-item mb-1">
                <div class="nav-section-header">
                    <h6 class="sidebar-heading text-uppercase">
                        <i class="bi bi-bar-chart me-2"></i>Reports
                    </h6>
                </div>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link" href="#">
                    <i class="bi bi-graph-up me-3"></i>
                    <span>Sales Report</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link" href="#">
                    <i class="bi bi-pie-chart me-3"></i>
                    <span>Analytics</span>
                </a>
            </li>

            <!-- System Section -->
            <li class="nav-item mb-1">
                <div class="nav-section-header">
                    <h6 class="sidebar-heading text-uppercase">
                        <i class="bi bi-gear me-2"></i>System
                    </h6>
                </div>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link" href="{{ route('landingpage') }}" target="_blank">
                    <i class="bi bi-eye me-3"></i>
                    <span>View Site</span>
                    <i class="bi bi-box-arrow-up-right ms-auto"></i>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link" href="{{ route('logout') }}">
                    <i class="bi bi-box-arrow-right me-3"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>

        <!-- Sidebar Footer -->
        <div class="sidebar-footer mt-auto p-3">
            <div class="small text-light opacity-75">
                <div class="fw-bold">{{ auth()->user()->name }}</div>
                <div>Administrator</div>
            </div>
        </div>
    </div>
</nav>

<style>
    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 99;
        width: 280px;
        background: linear-gradient(180deg, #1e293b 0%, #334155 100%);
        box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
        overflow-x: hidden;
        display: flex;
        flex-direction: column;
    }

    .sidebar .position-sticky {
        position: relative;
        display: flex;
        flex-direction: column;
        flex: 1;
        overflow-y: auto;
        padding-top: 76px;
    }

    .sidebar-brand {
        background: rgba(0, 0, 0, 0.2);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        flex-shrink: 0;
        padding: 1.5rem;
    }

    .sidebar-divider {
        border-color: rgba(255, 255, 255, 0.15);
        margin: 0;
        flex-shrink: 0;
    }

    .sidebar .nav {
        flex: 1;
        overflow-y: auto;
    }

    .sidebar-brand-text {
        line-height: 1.2;
        text-align: center;
    }

    .nav-section-header {
        margin: 1rem 0 0.5rem 0;
        flex-shrink: 0;
    }

    .sidebar-heading {
        font-size: 0.75rem;
        font-weight: 700;
        color: #94a3b8;
        padding: 0.5rem 1rem;
        margin: 0;
        letter-spacing: 0.05em;
    }

    .sidebar .nav-link {
        font-weight: 500;
        color: #cbd5e1;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        margin: 0 0.5rem;
        transition: all 0.3s ease;
        position: relative;
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .sidebar .nav-link:hover {
        color: #ffffff;
        background: rgba(59, 130, 246, 0.15);
        transform: translateX(4px);
    }

    .sidebar .nav-link.active {
        color: #ffffff;
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
    }

    .sidebar .nav-link.active::before {
        content: '';
        position: absolute;
        left: -0.5rem;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 20px;
        background: #fbbf24;
        border-radius: 2px;
    }

    .sidebar .nav-link i {
        font-size: 1.1rem;
        width: 20px;
        text-align: center;
    }

    .sidebar .nav-link .badge {
        font-size: 0.65rem;
        padding: 0.25rem 0.5rem;
        margin-left: auto;
    }

    .sidebar-footer {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(0, 0, 0, 0.2);
        flex-shrink: 0;
        padding: 1rem;
    }

    /* Custom Scrollbar */
    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 3px;
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.5);
    }

    /* Responsive Design */
    @media (max-width: 767.98px) {
        .sidebar {
            top: 0;
            left: -280px;
            transition: left 0.3s ease;
        }

        .sidebar.show {
            left: 0;
        }

        .sidebar .position-sticky {
            padding-top: 76px;
        }

        .sidebar-brand {
            padding: 1rem;
        }
    }

    /* Animation for badges */
    .sidebar .nav-link .badge {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
    }

    /* Tooltip styling */
    .sidebar .nav-link[title]:hover::after {
        content: attr(title);
        position: absolute;
        left: 100%;
        top: 50%;
        transform: translateY(-50%);
        background: #1f2937;
        color: white;
        padding: 0.5rem;
        border-radius: 4px;
        font-size: 0.75rem;
        white-space: nowrap;
        z-index: 1000;
        margin-left: 0.5rem;
    }
</style>

<script>
    // Sidebar toggle functionality for mobile
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebarMenu');
        const toggleBtn = document.querySelector('[data-bs-toggle="collapse"][data-bs-target="#sidebarMenu"]');

        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 767.98) {
                if (!sidebar.contains(e.target) && !toggleBtn?.contains(e.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });

        // Add smooth scrolling to sidebar
        const navLinks = document.querySelectorAll('.sidebar .nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Add loading state
                if (!this.href.includes('#')) {
                    this.style.opacity = '0.7';
                    this.innerHTML +=
                        ' <span class="spinner-border spinner-border-sm ms-2" role="status"></span>';
                }
            });
        });

        // Update badges with real-time data (optional)
        function updateBadges() {
            // This would typically fetch data from an API
            const badges = document.querySelectorAll('.sidebar .badge');
            badges.forEach(badge => {
                if (badge.textContent && !isNaN(badge.textContent)) {
                    badge.style.animation = 'pulse 0.5s ease';
                    setTimeout(() => {
                        badge.style.animation = '';
                    }, 500);
                }
            });
        }

        // Update badges every 30 seconds (optional)
        // setInterval(updateBadges, 30000);
    });
</script>
