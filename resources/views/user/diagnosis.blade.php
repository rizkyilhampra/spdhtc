@extends('layouts.user.app')
@section('content')
    <div id="diagnosis" class="row min-vh-100 align-content-center section">
        {{-- ISI CONTENT DISINI --}}

        Content

        {{-- END CONTENT --}}
    </div>
@endsection

@push('scriptPerPage')
    <script type="text/javascript">
        $(document).ready(function() {
            applyNavbarClassesDark();
            $('.diagnosis').addClass('active');
            let navLink = document.querySelector('ul.navbar-nav').querySelectorAll('li a');
            for (let i = 0; i < navLink.length; i++) {
                navLink[i].setAttribute('href', '{{ route('index') }}');
            }
        });
    </script>
@endpush
