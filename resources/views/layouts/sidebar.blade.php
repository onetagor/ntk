<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">Admin Panel</span>
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
                @canany(['admin-create', 'admin-edit', 'admin-delete', 'role-create', 'role-edit', 'role-delete'])
                <li class="nav-header">USER MANAGEMENT</li>
                
                @can('admin-view')
                <li class="nav-item">
                    <a href="{{ route('admin.admins.index') }}" class="nav-link {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>Admin Users</p>
                    </a>
                </li>
                @endcan

                @can('role-view')
                <li class="nav-item">
                    <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-shield-lock-fill"></i>
                        <p>Roles & Permissions</p>
                    </a>
                </li>
                @endcan
                @endcanany

                {{-- CMS Management --}}
                @canany(['site-setting-edit', 'slider-view', 'service-view', 'package-view', 'statistic-view', 'blog-view', 'testimonial-view', 'newsletter-view'])
                <li class="nav-header">CMS MANAGEMENT</li>

                @can('site-setting-edit')
                <li class="nav-item">
                    <a href="{{ route('admin.site-settings.index') }}" class="nav-link {{ request()->routeIs('admin.site-settings.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-gear-fill"></i>
                        <p>Site Settings</p>
                    </a>
                </li>
                @endcan

                @can('slider-view')
                <li class="nav-item">
                    <a href="{{ route('admin.sliders.index') }}" class="nav-link {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-images"></i>
                        <p>Sliders</p>
                    </a>
                </li>
                @endcan

                @can('service-view')
                <li class="nav-item">
                    <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-bag-check-fill"></i>
                        <p>Services</p>
                    </a>
                </li>
                @endcan

                @can('package-view')
                <li class="nav-item">
                    <a href="{{ route('admin.packages.index') }}" class="nav-link {{ request()->routeIs('admin.packages.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>Packages</p>
                    </a>
                </li>
                @endcan

                @can('statistic-view')
                <li class="nav-item">
                    <a href="{{ route('admin.statistics.index') }}" class="nav-link {{ request()->routeIs('admin.statistics.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-graph-up-arrow"></i>
                        <p>Statistics</p>
                    </a>
                </li>
                @endcan

                @can('blog-view')
                <li class="nav-item">
                    <a href="{{ route('admin.blogs.index') }}" class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-newspaper"></i>
                        <p>Blogs</p>
                    </a>
                </li>
                @endcan

                @can('testimonial-view')
                <li class="nav-item">
                    <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-chat-quote-fill"></i>
                        <p>Testimonials</p>
                    </a>
                </li>
                @endcan

                @can('newsletter-view')
                <li class="nav-item">
                    <a href="{{ route('admin.newsletters.index') }}" class="nav-link {{ request()->routeIs('admin.newsletters.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-envelope-fill"></i>
                        <p>Newsletters</p>
                    </a>
                </li>
                @endcan
                @endcanany

            </ul>
        </nav>
    </div>
</aside>
