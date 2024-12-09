<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Build and Service">
    <meta name="description" content="">

    <title>10122214 - Salsa Ridzkya - IF6</title>

    <!-- Icon -->
    <link rel="shortcut icon" href="{{ asset('assets-admin/images/coffe-shop.jpg') }}" type="image/x-icon">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets-user/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets-user/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-user/assets/css/templatemo-edu-meeting.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-user/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-user/assets/css/lightbox.css') }}">
    @stack('stylesheet')
</head>

<body>
    @include('user.components.navbar')

    @yield('content')
    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('assets-user/vendor/jquery/jquery.min.js') }}"></script>
    {{-- <script src="{{ asset('assets-user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}

    <script src="{{ asset('assets-user/assets/js/isotope.min.js') }}"></script>
    <script src="{{ asset('assets-user/assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('assets-user/assets/js/lightbox.js') }}"></script>
    <script src="{{ asset('assets-user/assets/js/tabs.js') }}"></script>
    <script src="{{ asset('assets-user/assets/js/video.js') }}"></script>
    <script src="{{ asset('assets-user/assets/js/slick-slider.js') }}"></script>
    <script src="{{ asset('assets-user/assets/js/custom.js') }}"></script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
            var
                direction = section.replace(/#/, ''),
                reqSection = $('.section').filter('[data-section="' + direction + '"]'),
                reqSectionPos = reqSection.offset().top - 0;

            if (isAnimate) {
                $('body, html').animate({
                        scrollTop: reqSectionPos
                    },
                    800);
            } else {
                $('body, html').scrollTop(reqSectionPos);
            }

        };

        var checkSection = function checkSection() {
            $('.section').each(function() {
                var
                    $this = $(this),
                    topEdge = $this.offset().top - 80,
                    bottomEdge = topEdge + $this.height(),
                    wScroll = $(window).scrollTop();
                if (topEdge < wScroll && bottomEdge > wScroll) {
                    var
                        currentId = $this.data('section'),
                        reqLink = $('a').filter('[href*=\\#' + currentId + ']');
                    reqLink.closest('li').addClass('active').
                    siblings().removeClass('active');
                }
            });
        };

        $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function(e) {
            e.preventDefault();
            showSection($(this).attr('href'), true);
        });

        $(window).scroll(function() {
            checkSection();
        });
    </script>
</body>

</html>
