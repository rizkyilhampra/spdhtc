<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}">SPDHTC</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        {{-- <a href="index.html" class="">SPDHTC</a> --}}
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="nav-item dropdown">
            <a href="{{ route('home') }}" class="nav-link has-dropdown"><i
                    class="fas fa-fire"></i><span>Dashboard</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="index-0.html">General Dashboard</a></li>
                <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
            </ul>
        </li>
    </ul>
</aside>
