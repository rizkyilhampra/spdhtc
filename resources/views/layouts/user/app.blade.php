<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPDHTC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/spesifiedAssets/user/style.css') }}">
    <script src="https://kit.fontawesome.com/06b8a1e79b.js" crossorigin="anonymous"></script>
</head>

<body class="bg-light-subtle">
    <main>
        <section>
            @include('layouts.user.navbar')
            <div class="container-fluid">
                @include('user.beranda')
                @include('user.diagnosis')
                @include('user.penyakit')
                @include('user.kontak')
            </div>
        </section>
    </main>
    @include('layouts.user.footer')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script>
        function applyNavbarClassesDark() {
            return $('.navbar')
                .removeClass('bg-body-transparent')
                .addClass('color-fren-green')
                .attr('data-bs-theme', 'dark')
                .css({
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
                .addClass('bg-body-transparent')
                .css({
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
            $('.navbar-nav li a').first().addClass('active');

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
            $(window).scroll(function() {
                if ($(this).scrollTop() > 5) {
                    applyNavbarClassesDark();
                } else {
                    applyNavbarClassesLight();
                    if (navbarActive) {
                        applyNavbarClassesDark();
                    }
                }
                var scrollPosition = $(this).scrollTop();
                $('div.section').each(function() {
                    var sectionTop = $(this).offset().top - 50;
                    var sectionBottom = sectionTop + $(this).outerHeight();
                    if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                        $('.navbar-nav li a').removeClass('active');
                        $('.navbar-nav li a[href="#' + $(this).attr('id') + '"]').addClass(
                            'active');
                    }
                });
            });
            const myCarousel = document.getElementById('carouselExample')
            myCarousel.addEventListener('slide.bs.carousel', event => {
                const id = event.relatedTarget.id;
                if (id == 'people2') {
                    $('#descPeople1 ').addClass('d-none');
                    $('#descPeople2').removeClass('d-none');
                } else if (id == 'people1') {
                    $('#descPeople2').addClass('d-none');
                    $('#descPeople1').removeClass('d-none');
                }
            })
        });
    </script>
</body>

</html>
