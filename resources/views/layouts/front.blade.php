<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="{{ asset('front/favicon.png') }}">

    <meta name="description" content="" />
    <meta name="keywords" content="" />

    @include('layouts.components.front.styles')

    <title>@yield('title')</title>
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>

        @yield('content')

    </div> <!-- .site-wrap -->

    <script src="{{ asset('front/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('front/js/popper.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('front/js/aos.js') }}"></script>
    <script src="{{ asset('front/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('front/js/jarallax.min.js') }}"></script>
    <script src="{{ asset('front/js/jarallax-element.min.js') }}"></script>
    <script src="{{ asset('front/js/lozad.min.js') }}"></script>
    <script src="{{ asset('front/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('front/js/three.min.js') }}"></script>
    <script src="{{ asset('front/js/TweenMax.min.js') }}"></script>
    <script src="{{ asset('front/js/OBJLoader.js') }}"></script>
    <script src="{{ asset('front/js/ParticleHead.js') }}"></script>

    <script src="{{ asset('front/js/jquery.sticky.js') }}"></script>

    <script src="{{ asset('front/js/typed.js') }}"></script>
    <script>
        var typed = new Typed('.typed-words', {
            strings: [" Anything", " Trigonometry", " Algebraic Equations"],
            typeSpeed: 80,
            backSpeed: 80,
            backDelay: 4000,
            startDelay: 1000,
            loop: true,
            showCursor: true
        });
    </script>

    <script src="{{ asset('front/js/main.js') }}"></script>

</body>

</html>
