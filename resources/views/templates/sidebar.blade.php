<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('homepage') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="sidebar-brand-text mx-1">Bimbel System</div>
    </a>

    @auth
        @php
            $roleId = Auth::user()->role_id;

            // Ambil semua module_name yang dimiliki role ini
            $userModules = DB::table('role_modules as rm')
                ->join('modules as m', 'rm.module_id', '=', 'm.id')
                ->where('rm.role_id', $roleId)
                ->pluck('m.name')
                ->toArray();
        @endphp

        <script>
            console.log('Role ID: {{ $roleId }}');
            console.log('User Modules:', @json($userModules));
            console.log('Modules Count: {{ count($userModules) }}');
        </script>

        <!-- Dashboard -->
        <li class="nav-item {{ request()->routeIs('homepage') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('homepage') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <!-- Management Section -->

        <div class="sidebar-heading">Management</div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('role.index') }}">
                <i class="fas fa-fw fa-user-tie"></i>
                <span>Role Management</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('module.index') }}">
                <i class="fas fa-fw fa-cubes"></i>
                <span>Module Management</span>
            </a>
        </li>

        @if (in_array('view_user', $userModules))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>User Management</span>
                </a>
            </li>
        @endif

        <!-- Data Master Section -->
        @if (in_array('view_center', $userModules) ||
                in_array('view_student', $userModules) ||
                in_array('view_teacher', $userModules) ||
                in_array('view_classroom', $userModules))
            <div class="sidebar-heading">Data Master</div>

            @if (in_array('view_center', $userModules))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('center.index') }}">
                        <i class="fas fa-fw fa-building"></i>
                        <span>Centers</span>
                    </a>
                </li>
            @endif

            @if (in_array('view_student', $userModules))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('student.index') }}">
                        <i class="fas fa-fw fa-user-graduate"></i>
                        <span>Students</span>
                    </a>
                </li>
            @endif

            @if (in_array('view_teacher', $userModules))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('teacher.index') }}">
                        <i class="fas fa-fw fa-chalkboard-teacher"></i>
                        <span>Teachers</span>
                    </a>
                </li>
            @endif

            @if (in_array('view_classroom', $userModules))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('classroom.index') }}">
                        <i class="fas fa-fw fa-school"></i>
                        <span>Classes</span>
                    </a>
                </li>
            @endif
        @endif

        <!-- Finance Section -->
        @if (in_array('view_fee', $userModules) || in_array('view_payment', $userModules))
            <div class="sidebar-heading">Finance</div>

            @if (in_array('view_fee', $userModules))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('fee.index') }}">
                        <i class="fas fa-fw fa-money-bill"></i>
                        <span>Fees</span>
                    </a>
                </li>
            @endif

            @if (in_array('view_payment', $userModules))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('payment.index') }}">
                        <i class="fas fa-fw fa-credit-card"></i>
                        <span>Payments</span>
                    </a>
                </li>
            @endif
        @endif

        <!-- Academic Section -->
        @if (in_array('view_attendance', $userModules))
            <div class="sidebar-heading">Academic</div>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('presence.index') }}">
                    <i class="fas fa-fw fa-clipboard-list"></i>
                    <span>Attendance</span>
                </a>
            </li>
        @endif

        <!-- Report Section -->
        @if (in_array('view_report', $userModules))
            <div class="sidebar-heading">Reports</div>
            @if (in_array('view_attendance', $userModules))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('presence.report') }}">
                        <i class="fas fa-fw fa-chart-line"></i>
                        <span>Attendance Report</span>
                    </a>
                </li>
            @endif
            @if (in_array('view_payment', $userModules))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('payment.index') }}">
                        <i class="fas fa-fw fa-chart-pie"></i>
                        <span>Financial Report</span>
                    </a>
                </li>
            @endif
        @endif

    @endauth

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
            @csrf
        </form>
    </li>

</ul>
