<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
    <ul id="sidebarnav">
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('index') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-home"></i>
                </span>
                <span class="hide-menu">Company Profile</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('operation.index') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-pencil"></i>
                </span>
                <span class="hide-menu">Library</span>
            </a>
        </li>
    </ul>
</nav>
