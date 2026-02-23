<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="{{ asset('assets/img/ntk-logo.jpg') }}" alt="NTK Logo" class="brand-image opacity-75 shadow"> 
            <span class="brand-text fw-light">NTK Admin</span> 
        </a>
    </div>
    
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- User Management --}}
                <li class="nav-header">USER MANAGEMENT</li>
                
                <li class="nav-item">
                    <a href="{{ route('admin.admins.index') }}" class="nav-link {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>Admin Users</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/role/permission/*') || request()->routeIs('admin.roles.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/role/permission/*') || request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-shield-lock-fill"></i>
                        <p>
                            Role & Permission
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Roles Manager</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.roleIndex') }}" class="nav-link {{ request()->is('admin/role/permission/role/*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Role List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.permissionIndex') }}" class="nav-link {{ request()->is('admin/role/permission/permission/*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Permission List</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Orders Management --}}
                <li class="nav-header">ORDERS</li>

                <li class="nav-item">
                    <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-cart-check-fill"></i>
                        <p>All Orders</p>
                    </a>
                </li>

                {{-- CMS Management --}}
                <li class="nav-header">CMS MANAGEMENT</li>

                <li class="nav-item">
                    <a href="{{ route('admin.site-settings.index') }}" class="nav-link {{ request()->routeIs('admin.site-settings.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-gear-fill"></i>
                        <p>Site Settings</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.sliders.index') }}" class="nav-link {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-images"></i>
                        <p>Sliders</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-bag-check-fill"></i>
                        <p>Services</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.packages.index') }}" class="nav-link {{ request()->routeIs('admin.packages.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>Packages</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.statistics.index') }}" class="nav-link {{ request()->routeIs('admin.statistics.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-graph-up-arrow"></i>
                        <p>Statistics</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.blogs.index') }}" class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-newspaper"></i>
                        <p>Blogs</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-chat-quote-fill"></i>
                        <p>Testimonials</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.newsletters.index') }}" class="nav-link {{ request()->routeIs('admin.newsletters.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-envelope-fill"></i>
                        <p>Newsletters</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
