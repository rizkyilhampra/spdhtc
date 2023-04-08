<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPDHTC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/spesified-assets/user/style.css') }}">
    <script src="https://kit.fontawesome.com/06b8a1e79b.js" type="text/javascript" crossorigin="anonymous"></script>
    @stack('stylePerPage')
</head>

<body class="bg-light-subtle">
    <main>
        <section>
            @include('layouts.user.navbar')

            <div class="container-fluid" id="containerContent">
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

    <script type="text/javascript">
        function applyNavbarClassesDark() {
            return $('.navbar')
                .removeClass('bg-body-transparent')
                .addClass('color-fren-green')
                .attr('data-bs-theme', 'dark').css({
                    'transition': 'all .5s ease-in-out'
                }),
                $('svg path')
                .attr('style', 'fill: #fff !important')
                .css({
                    'transition': 'all .5s ease-in-out'
                }),
                $('.navbar-nav li a div button').removeClass('btn-outline-dark').addClass('btn-outline-light').css({
                    'transition': 'all .5s ease-in-out'
                })
        }

        function applyNavbarClassesLight() {
            return $('.navbar')
                .removeClass('color-fren-green')
                .removeAttr('data-bs-theme')
                .addClass('bg-body-transparent').css({
                    'transition': 'all .5s ease-in-out'
                }),
                $('svg path')
                .removeAttr('style')
                .css({
                    'transition': 'all .5s ease-in-out'
                }),
                $('.navbar-nav li a div button').removeClass('btn-outline-light').addClass('btn-outline-dark').css({
                    'transition': 'all .5s ease-in-out'
                })
        }

        $(document).ready(function() {
            let navbarActive = false;
            $('.navbar').on('show.bs.collapse', () => {
                applyNavbarClassesDark();
                navbarActive = true;
            });
            $('.navbar').on('hide.bs.collapse', () => {
                navbarActive = false;
                applyNavbarClassesLight();
                if ($(this).scrollTop() > 5) {
                    applyNavbarClassesDark();
                }
            });
        });
    </script>
    @stack('scriptPerPage')
</body>

</html>
