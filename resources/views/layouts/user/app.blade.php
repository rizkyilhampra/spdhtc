<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="Sistem Pakar, Forward Chaining, Penyakit Tanaman Cabai">
    <meta name="description"
        content="Sistem pakar untuk mendeteksi/mendiagnosis penyakit pada tanaman cabai dengan algoritma forward chaining">

    <link rel="icon" href="{{ asset('favicon-cabai.ico') }}">
    <title>@yield('title') SPDHTC</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preload" as="style" href="{{ asset('/spesified-assets/splash-screen.css') }}">
    <link rel="stylesheet" href="{{ asset('/spesified-assets/splash-screen.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="preload"
        as="style" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
        crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preload" as="style" href="{{ asset('/spesified-assets/user/style.css') }}">
    @stack('styleLibraries')

    <link rel="stylesheet" href="{{ asset('/spesified-assets/user/style.css') }}">
    <script defer src="https://kit.fontawesome.com/06b8a1e79b.js" type="text/javascript" crossorigin="anonymous"></script>
    <link rel="preload" as="style" href="{{ asset('/spesified-assets/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('/spesified-assets/aos.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="{{ asset('/spesified-assets/chocolat.css') }}" type="text/css" media="screen">
    @stack('stylePerPage')
</head>

<body class="bg-light-subtle">
    <div class="splash-screen">
        <div class="la-timer la-dark la-3x">
            <div>
            </div>
        </div>
    </div>
    <main>
        <section>
            @include('layouts.user.navbar')
            <div class="overflow-x-hidden" id="containerContent">
                @yield('content')
            </div>
        </section>
    </main>
    @include('layouts.user.footer')
    <div class="rounded-circle" id="upScroll">
        <i class="fas fa-chevron-up fa-lg"></i>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-parallax-js@5.5.1/dist/simpleParallax.min.js" async
        type="text/javascript"></script>
    <script src="{{ asset('/spesified-assets/aos.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script async type="text/javascript" src="{{ asset('/spesified-assets/chocolat.js') }}"></script>

    @stack('scriptPerPage')

    <script type="text/javascript" src="{{ asset('/spesified-assets/user/script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/spesified-assets/user/diagnosis.js') }}"></script>
</body>

</html>
