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


            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
      
                    <button type="submit" class="nav-link collapsed"
                        onclick="return confirm('Are you sure you want to logout?')">
                        <i class="bi bi-box-arrow-right"></i> Sign Out
                    </button>
                </form>
            </li>


    </ul>

</aside>
