<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Pages</li>
        @can('viewUser')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('user.index') }}">
                    <i class="bi bi-person"></i>
                    <span>User Account</span>
                </a>
            </li>
        @endcan

        @can('viewHR')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('hr.index') }}">
                    <i class="bi bi-person"></i>
                    <span>Human Resource</span>
                </a>
            </li>
        @endcan

        @can('viewEmployee')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('employee.index') }}">
                    <i class="bi bi-person"></i>
                    <span>Employee Profile</span>
                </a>
            </li>
        @endcan

        @can('viewSystemAdmin')
            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-register.html">
                    <i class="bi bi-card-list"></i>
                    <span>Quit</span>
                </a>
            </li>
        @endcan

    </ul>

</aside>
