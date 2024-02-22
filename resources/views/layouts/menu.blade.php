<li class="nav-item">
    <a href="" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item menu-open">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
            User Management
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link ">
                <i class="far fa-circle nav-icon text-danger"></i>
                <p>User</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('role.index') }}" class="nav-link ">
                <i class="far fa-circle nav-icon text-warning"></i>
                <p>Role</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('permission.index') }}" class="nav-link ">
                <i class="far fa-circle nav-icon text-success"></i>
                <p>Permission</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('module.index') }}" class="nav-link ">
                <i class="nav-icon far fa-circle"></i>
                <p>Module</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="{{ route('pagecontent.index') }}" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>Page Details</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('blogs.index') }}" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>Blog</p>
    </a>
</li>

 {{-- <li class="nav-item">
    <a href="#" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item menu-open">
    <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-user"></i>
        <p>
            User Managment
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link active">
                <i class="far fa-circle nav-icon text-danger"></i>
                <p>User</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('role.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon text-warning"></i>
                <p>Role</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('permission.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon text-success"></i>
                <p>Permission</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('module.index') }}" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>Module</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="{{ route('homepage.index') }}" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>Home Page</p>
    </a>
</li>  --}}
