<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Restaurantly Bootstrap Template - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="{{ asset('Site/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('Site/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="{{ asset('Site/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Site/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('Site/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Site/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('Site/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Site/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Site/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link href="{{ asset('Site/css/style.css') }}" rel="stylesheet">
</head>

<body>


@include('Site.Common.TopBar')
@include('Site.Common.Navbar')

@yield('SiteContent')

@include('Site.Common.Footer')
@include('Site.Common.Preloader')

<!-- Vendor JS Files -->
<script src="{{ asset('Site/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('Site/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('Site/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('Site/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('Site/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('Site/vendor/swiper/swiper-bundle.min.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('Site/js/main.js') }}"></script>

</body>

</html>
