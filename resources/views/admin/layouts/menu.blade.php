@php
    $url_segment = Request::segment(2);
    $sub_url_segment = Request::segment(3);
@endphp

<li class="nav-item">
    <a href="{{ route('dashboard.index') }}" class="nav-link @if ($url_segment == '' || $url_segment == 'dashboard') active @endif ">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item @if ($url_segment == 'user' || $url_segment == 'role' || $url_segment == 'permission' || $url_segment == 'module') menu-open @endif">
    <a href="#" class="nav-link nav-link @if ($url_segment == 'user' || $url_segment == 'role' || $url_segment == 'permission' || $url_segment == 'module') active @endif">
        <i class="nav-icon fas fa-user"></i>
        <p>
            User Management
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link {{ $url_segment == 'user' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon text-danger"></i>
                <p>User</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('role.index') }}" class="nav-link {{ $url_segment == 'role' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon text-warning"></i>
                <p>Role</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('permission.index') }}" class="nav-link {{ $url_segment == 'permission' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon text-success"></i>
                <p>Permission</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('module.index') }}" class="nav-link  {{ $url_segment == 'module' ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Module</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="{{ route('pagecontent.index') }}" class="nav-link  {{ $url_segment == 'pagecontent' ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>Page Details</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('blogs.index') }}" class="nav-link {{ $url_segment == 'blogs' ? 'active' : '' }}">
        <i class="nav-icon fas fa-edit"></i>
        <p>Blog</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('tag.index') }}" class="nav-link {{ $url_segment == 'tag' ? 'active' : '' }}">
        <i class="nav-icon fas fa-stroopwafel"></i>
        <p>Tag</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('category.index') }}" class="nav-link {{ $url_segment == 'category' ? 'active' : '' }}">
        <i class="nav-icon fas fa-indent"></i>
        <p>Category</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('topic.index') }}" class="nav-link {{ $url_segment == 'topic' ? 'active' : '' }}">
        <i class="fa fa-tasks" aria-hidden="true"></i>
        <p>Topic</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('course.index') }}" class="nav-link {{ $url_segment == 'course' ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>Course</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('countries.index') }}" class="nav-link {{ $url_segment == 'countries' ? 'active' : '' }}">
        <i class="nav-icon far fa-map"></i>
        <p>Country</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('locations.index') }}" class="nav-link  {{ $url_segment == 'locations' ? 'active' : '' }} ">
        <i class="nav-icon fas fa-map-marker-alt"></i>
        <p>Location</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('region.index') }}" class="nav-link  {{ $url_segment == 'region' ? 'active' : '' }} ">
        <i class="nav-icon fas fa-map-pin"></i>
        <p>Region</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('actvities.index') }}" class="nav-link  {{ $url_segment == 'actvities' ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>Activity Log</p>
    </a>
</li>

