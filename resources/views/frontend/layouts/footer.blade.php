<footer class="footer" dir="rtl">
    <div class="container-fluid">
        <div class="footer-content">
            <div class="about-section">
                <h3>من نحن</h3>
                <p>
                    نحن متخصصون في تقديم أفضل أنواع العطارة والمكسرات الفاخرة. استمتع
                    بتشكيلة مميزة من المكسرات الطازجة والتوابل العطرية التي تضيف لمسة من
                    الفخامة إلى حياتك. اكتشف الجودة والذوق الرفيع في كل منتج نقدمه.
                </p>
            </div>
            <div class="logo-section d-flex justify-content-center">
                <img src="images/logo.png" alt="logo" srcset="">
            </div>
            <div class="links-section">
                <h3>روابط تهمك</h3>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{route('contact')}}"> سياسة الإرجاع</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('about-us')}}"> إرجاع الطلبات</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('blog')}}"> الإسئلة الأكثر تكرارا</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('register.form')}}"> الشروط والأحكام</a>
                    </li>
                </ul>
            </div>

            <div class="social-section">
                <h3>وسائل التواصل</h3>
                <div class="social-icons">
                    <a href="https://www.tiktok.com/@aqtralbahrai"> <i class="fab fa-tiktok"></i>
                    </a>
                    <a href="https://www.snapchat.com/add/qtrlbhryn23?share_id=l2aUSQoLPAY&locale=en-US">
                        <i class="fab fa-snapchat"></i>
                    </a>
                    <a href="https://www.instagram.com/aqtrlbhryn/profilecard/?igsh=c3NuMHMxbmEzanU3"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom-copyright" style="color:#fff">
            <hr class="dropdown-divider">
            <h4>
                كل الحقوق محفوظة © {{date('Y')}} صمم بواسطة WebTeam.
            </h4>
        </div>
    </div>
</footer>


<!-- Jquery -->
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery-migrate-3.0.0.js')}}"></script>
<script src="{{asset('frontend/js/jquery-ui.min.js')}}"></script>
<!-- Popper JS -->
<script src="{{asset('frontend/js/popper.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<!-- Color JS -->
<script src="{{asset('frontend/js/colors.js')}}"></script>
<!-- Slicknav JS -->
<script src="{{asset('frontend/js/slicknav.min.js')}}"></script>
<!-- Owl Carousel JS -->
<script src="{{asset('frontend/js/owl-carousel.js')}}"></script>
<!-- Magnific Popup JS -->
<script src="{{asset('frontend/js/magnific-popup.js')}}"></script>
<!-- Waypoints JS -->
<script src="{{asset('frontend/js/waypoints.min.js')}}"></script>
<!-- Countdown JS -->
<script src="{{asset('frontend/js/finalcountdown.min.js')}}"></script>
<!-- Nice Select JS -->
<script src="{{asset('frontend/js/nicesellect.js')}}"></script>
<!-- Flex Slider JS -->
<script src="{{asset('frontend/js/flex-slider.js')}}"></script>
<!-- ScrollUp JS -->
<script src="{{asset('frontend/js/scrollup.js')}}"></script>
<!-- Onepage Nav JS -->
<script src="{{asset('frontend/js/onepage-nav.min.js')}}"></script>
{{-- Isotope --}}
<script src="{{asset('frontend/js/isotope/isotope.pkgd.min.js')}}"></script>
<!-- Easing JS -->
<script src="{{asset('frontend/js/easing.js')}}"></script>

<!-- Active JS -->
<script src="{{asset('frontend/js/active.js')}}"></script>
<style>
    .footer {
        background-color: #4B5320 !important;
    }
</style>

@stack('scripts')
<script>
    setTimeout(function() {
        $('.alert').slideUp();
    }, 5000);
    $(function() {
        // ------------------------------------------------------- //
        // Multi Level dropdowns
        // ------------------------------------------------------ //
        $("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
            event.preventDefault();
            event.stopPropagation();

            $(this).siblings().toggleClass("show");


            if (!$(this).next().hasClass('show')) {
                $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
            }
            $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
                $('.dropdown-submenu .show').removeClass("show");
            });

        });
    });
</script>

<style>
    /* Footer Styles */
    .footer {
        background: url('images/footer_img.png') no-repeat center center;
        background-size: cover;
        color: #fff;
        padding: 40px 20px;
        text-align: right;
    }

    .footer-content {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 20px;
    }

    .about-section,
    .logo-section,
    .links-section,
    .social-section {
        flex: 1 1 calc(30% - 20px);
        min-width: 250px;
    }

    .links-section,
    .social-section {
        flex: 1 1 calc(20% - 20px);
        min-width: 240px;
    }

    .about-section h3,
    .links-section h3,
    .social-section h3 {
        font-size: 28px;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .about-section p {
        text-align: justify;
        font-size: 17px;
        line-height: 1.6;
        font-weight: 600;
    }

    .logo-section img {
        height: 150px;
        width: 150px;
        border-radius: 50%;
    }

    .links-section ul {
        list-style: none;
        padding: 0;
        padding-right: 15px;
    }

    .links-section ul li {
        margin-bottom: 10px;
    }

    .links-section ul li a {
        text-decoration: none;
        color: #fff;
        font-size: 17px;
        transition: color 0.3s ease;
    }

    .links-section ul li a:hover {
        color: #ff9800;
    }


    .social-icons a {
        font-size: 30px;
        margin-right: 10px;
        color: #fff;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .social-icons a:hover {
        color: #ff9800;
    }

    .footer-bottom-copyright {
        text-align: center;
        margin-top: 20px;
        font-size: 12px;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        padding-top: 10px;
    }

    .about-section p,
    .footer-bottom-copyright h4 {
        font-weight: 600;
        color: #fff;
    }

    .footer-bottom-copyright .dropdown-divider {
        height: 8px;
        color: #fff;
        background-color: #fff;
        margin: 0 250px;
        border-radius: 15px;
        margin-bottom: 15px;
    }
</style>
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
