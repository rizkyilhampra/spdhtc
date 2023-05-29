<form class="form-inline mr-auto">

    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
</form>
<ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown"
            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ auth()->user()->getAvatarAttribute() }}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-title">{{ $loginDuration }} yang lalu</div>
            {{-- <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
            </a>
            <a href="features-activities.html" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Activities
            </a>
            <a href="features-settings.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
            </a> --}}
            <a href="" id="buttonLogout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form action="{{ route('logout') }}" method="post" id="formLogout" hidden style="display: none">
                @csrf
            </form>
        </div>
    </li>
</ul>


@push('jsCustom')
    <script>
        var buttonLogout = document.getElementById('buttonLogout');
        buttonLogout.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('formLogout').submit();
        });
    </script>
@endpush
