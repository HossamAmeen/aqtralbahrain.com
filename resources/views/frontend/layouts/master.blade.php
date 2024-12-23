<!DOCTYPE html>
<html lang="zxx">

<head>
    @include('frontend.layouts.head')
</head>
<style>
    .fixed-whatsapp-button {
        position: fixed;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 30px;
        text-decoration: none;
        color: #10ab07 !important;
        padding: 15px;
        border-radius: 50%;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
        z-index: 1000;
        transition: background-color 0.3s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
    }
</style>

<body class="js">

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    @include('frontend.layouts.notification')
    <!-- Header -->
    @include('frontend.layouts.header')
    <!--/ End Header -->
    @yield('main-content')


    <a href="https://wa.me/966509223647" class="fixed-whatsapp-button" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-whatsapp"></i>
    </a>

    @include('frontend.layouts.footer')

</body>

</html>