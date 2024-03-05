@php 
        $url_segment = Request::segment(1); $sub_url_segment = Request::segment(2);
    @endphp

<li class="nav-item">
    <a href="{{route('dashboard.index')}}" class="nav-link @if($url_segment == '' || $url_segment == 'dashboard') active @endif ">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item @if($url_segment == 'user' || $url_segment == 'role' || $url_segment == 'permission' || $url_segment == 'module') menu-open @endif">
    <a href="#" class="nav-link nav-link @if($url_segment == 'user' || $url_segment == 'role' || $url_segment == 'permission' || $url_segment == 'module') active @endif">
        <i class="nav-icon fas fa-user"></i>
        <p>
            User Management
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link @if($url_segment == 'user') active @endif">
                <i class="far fa-circle nav-icon text-danger"></i>
                <p>User</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('role.index') }}" class="nav-link @if($url_segment == 'role') active @endif">
                <i class="far fa-circle nav-icon text-warning"></i>
                <p>Role</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('permission.index') }}" class="nav-link @if($url_segment == 'permission') active @endif">
                <i class="far fa-circle nav-icon text-success"></i>
                <p>Permission</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('module.index') }}" class="nav-link @if($url_segment == 'module') active @endif">
                <i class="nav-icon far fa-circle"></i>
                <p>Module</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="{{ route('pagecontent.index') }}" class="nav-link @if($url_segment == 'pagecontent') active @endif">
        <i class="nav-icon fas fa-th"></i>
        <p>Page Details</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('blogs.index') }}" class="nav-link @if($url_segment == 'blogs') active @endif">
        <i class="nav-icon fas fa-edit"></i>
        <p>Blog</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('tag.index') }}" class="nav-link @if($url_segment == 'tag') active @endif">
        <i class="nav-icon fas fa-stroopwafel"></i>
        <p>Tag</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('category.index') }}" class="nav-link @if($url_segment == 'category') active @endif">
        <i class="nav-icon fas fa-indent"></i>
        <p>Category</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('countries.index') }}" class="nav-link @if($url_segment == 'countries') active @endif">
        <i class="nav-icon far fa-map"></i>
        <p>Country</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('locations.index') }}" class="nav-link @if($url_segment == 'locations') active @endif">
        <i class="nav-icon fas fa-map-marker-alt"></i>
        <p>Location</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('region.index') }}" class="nav-link @if($url_segment == 'region') active @endif">
        <i class="nav-icon fas fa-map-pin"></i>
        <p>Region</p>
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
