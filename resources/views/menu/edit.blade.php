@if ($isSuperAdmin)
    <!-- ... menu yang sudah ada ... -->

    <div class="sidebar-heading">
        Developer
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('menu.index') }}">
            <i class="fas fa-fw fa-bars"></i>
            <span>Menu Management</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('permission.index') }}">
            <i class="fas fa-fw fa-key"></i>
            <span>Permission Management</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('role.permission.index') }}">
            <i class="fas fa-fw fa-user-shield"></i>
            <span>Role Permissions</span>
        </a>
    </li>
@endif
