<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('admin.beranda') }}">SPDHTC</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        {{-- <a href="index.html" class="">SPDHTC</a> --}}
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="nav-item {{ request()->is('admin/beranda*') ? 'active' : '' }}">
            <a href="{{ route('admin.beranda') }}"><i class="fas fa-home"></i>
                <span>Beranda</span>
            </a>
        </li>
        <li class="nav-item {{ request()->is('admin/penyakit*') ? 'active' : '' }}">
            <a href="{{ route('admin.penyakit') }}"><i class="fas fa-medkit"></i>
                <span>Penyakit</span>
            </a>
        </li>
        <li class="nav-item {{ request()->is('admin/gejala*') ? 'active' : '' }}">
            <a href="{{ route('admin.gejala') }}"><i class="fas fa-flag"></i>
                <span>Gejala</span>
            </a>
        </li>
        <li class="nav-item {{ request()->is('admin/rule*') ? 'active' : '' }}">
            <a href="{{ route('admin.rule') }}"><i class="fas fa-landmark"></i>
                <span>Rule</span>
            </a>
        </li>
        <li class="nav-item {{ request()->is('admin/histori-diagnosis*') ? 'active' : '' }}">
            <a href="{{ route('admin.histori.diagnosis') }}"><i class="fas fa-fire"></i>
                <span>Histori</span>
            </a>
        </li>
    </ul>
</aside>
