@extends('frontend.layouts.master')
@section('title','Aqtr Albahrain || HOME PAGE')
@section('main-content')
<!-- Slider Area -->
@if(count($banners)>0)
<section id="Gslider" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach($banners as $key=>$banner)
        <li data-target="#Gslider" data-slide-to="{{$key}}" class="{{(($key==0)? 'active' : '')}}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner" role="listbox">
        @foreach($banners as $key=>$banner)
        <div class="carousel-item {{(($key==0)? 'active' : '')}}">
            <img class="first-slide" src="{{$banner->photo}}" alt="First slide">
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#Gslider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#Gslider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</section>
@endif

<!--/ End Slider Area -->



<!-- Start Products -->
<div class="product-area most-popular section" style="direction: rtl;">
    <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>المنتجات</h2>
                </div>
            </div>
            @foreach($product_lists as $product)

            <div class="col-3">
                <div class="card category-card">
                    <a href="{{route('product-detail',$product->slug)}}">
                        @php
                        $photo=explode(',',$product->photo);
                        // dd($photo);
                        @endphp
                        <img class="card-img-top" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                        {{-- <span class="out-of-stock">{{__('application.hot')}}</span> --}}
                    </a>
                    <div class="card-body">
                        <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- <div class="col-12">
                <div class="owl-carousel popular-slider">
                    @foreach($product_lists as $product)

                        <div class="single-product">
                            <div class="product-img">
                                <a href="{{route('product-detail',$product->slug)}}">
                                    @php
                                        $photo=explode(',',$product->photo);
                                    // dd($photo);
                                    @endphp
                                    <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                    <img class="hover-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                    {{-- <span class="out-of-stock">{{__('application.hot')}}</span> --}}
                                </a>
                                <div class="button-head">
                                    <div class="product-action">
                                        <a data-toggle="modal" data-target="#{{$product->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>{{__('application.quick_shop')}}</span></a>
                                        <a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}" ><i class=" ti-heart "></i><span>{{__('application.add_to_wishlist')}}</span></a>
                                    </div>
                                    <div class="product-action-2">
                                        <a href="{{route('add-to-cart',$product->slug)}}">{{__('application.add_to_cart')}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                                <div class="product-price">
                                    <span class="old">{{number_format($product->price,2)}}</span>
                                    @php
                                    $after_discount=($product->price-($product->price*$product->discount)/100)
                                    @endphp
                                    <span>{{number_format($after_discount,2)}}</span>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div> -->
        </div>
    </div>
</div>
<!-- End Products Area -->

@if($home_banner)
<div class=" align-items-center" style="border-radius: 10px; padding: 20px;">
    <div style="width: 100%;">
        <img class="img-fluid" src="https://aqtralbahrain.com/storage/files/6/banner1.png" alt="Home Banner" style="border-radius: 10px;">
    </div>
</div>
@endif

<!-- Start Most Required -->
<div class="product-area most-popular section" style="direction: rtl;">
    <div class="container-fluid px-5">

        <div class="row px-3 py-2">
            <div class="col-12">
                <div class="section-title">
                    <h2>الأكثر طلبا</h2>
                </div>
            </div>
        </div>
        <div class="row" style="background-color: #e1e1e14a;">
            <div class="col-12 owl-carousel popular-slider">
                @foreach($featured as $product)
                <div class="card product-card mx-2 my-4">
                    <img class="card-img-top" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                    <div class="card-body">
                        <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                        <div class="product-price">
                            <span class="old">{{number_format($product->price,2)}}ج.م</span>
                        </div>
                        <div class="product-actions d-flex justify-content-center align-items-center mt-4">
                            <button type="button" class="btn py-1 ml-2"><a href="{{route('add-to-cart',$product->slug)}}"><i class="ti-bag"></i> {{__('application.add_to_cart')}}</a></button>
                            <a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}"><i class=" ti-heart "></i></a>
                        </div>

                    </div>
                </div>
                <!-- Start Single Product -->
                <!-- <div class="single-product">
                    <div class="product-img">
                        <a href="{{route('product-detail',$product->slug)}}">
                            @php
                            $photo=explode(',',$product->photo);
                            // dd($photo);
                            @endphp
                            <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                            <img class="hover-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                            {{-- <span class="out-of-stock">{{__('application.hot')}}</span> --}}
                        </a>
                        <div class="button-head">
                            <div class="product-action">
                                <a data-toggle="modal" data-target="#{{$product->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>{{__('application.quick_shop')}}</span></a>
                                <a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}"><i class=" ti-heart "></i><span>{{__('application.add_to_wishlist')}}</span></a>
                            </div>
                            <div class="product-action-2">
                                <a href="{{route('add-to-cart',$product->slug)}}">{{__('application.add_to_cart')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                        <div class="product-price">
                            <span class="old">{{number_format($product->price,2)}}</span>
                            @php
                            $after_discount=($product->price-($product->price*$product->discount)/100)
                            @endphp
                            <span>{{number_format($after_discount,2)}}</span>
                        </div>
                    </div>
                </div> -->
                <!-- End Single Product -->

                @endforeach
            </div>
        </div>
    </div>
</div>

@if($home_banner)
<div class=" align-items-center" style="border-radius: 10px; padding: 20px;">
    <div style="width: 100%;">
        <img class="img-fluid" src="https://aqtralbahrain.com/storage/files/6/add-1.png" alt="Home Banner" style="border-radius: 10px;">
    </div>
</div>
@endif
<!-- Start last added -->
<div class="product-area most-popular section" style="direction: rtl;">
    <div class="container-fluid px-5">

        <div class="row px-3 py-2">
            <div class="col-12">
                <div class="section-title">
                    <h2> المضافة اخيرا</h2>
                </div>
            </div>
        </div>
        <div class="row" style="background-color: #e1e1e14a;">
            <div class="col-12 owl-carousel popular-slider">
                @foreach($featured as $product)
                <div class="card product-card mx-2 my-4">
                    <img class="card-img-top" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                    <div class="card-body">
                        <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                        <div class="product-price">
                            <span class="old">{{number_format($product->price,2)}}ج.م</span>
                        </div>
                        <div class="product-actions d-flex justify-content-center align-items-center mt-4">
                            <button type="button" class="btn py-1 ml-2"><a href="{{route('add-to-cart',$product->slug)}}"><i class="ti-bag"></i> {{__('application.add_to_cart')}}</a></button>
                            <a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}"><i class=" ti-heart "></i></a>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Start Offers -->
<div class="product-area most-popular section" style="direction: rtl;">
    <div class="container-fluid px-5">

        <div class="row px-3 py-2">
            <div class="col-12">
                <div class="section-title">
                    <h2> العروض</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($featured as $product)
            <div class="col-3">
                <div class="card product-card offers">
                    <img class="card-img-top" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                    <div class="card-body px-5">
                        <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                        <span class="text-muted">{{$product->title}}</a></span>
                        <div class="product-price">
                            @php
                            $after_discount=($product->price-($product->price*$product->discount)/100)
                            @endphp
                            <span class="price">{{number_format($after_discount,2)}}ج.م</span>
                            <span class="old-price">{{number_format($product->price,2)}}ج.م</span>
                        </div>
                        <div class="product-actions d-flex justify-content-center align-items-center mt-4">
                            <button type="button" class="btn py-1 btn-block ml-2"><a href="{{route('add-to-cart',$product->slug)}}"><i class="ti-bag"></i>
                                    <span>{{__('application.add_to_cart')}}</span>
                                </a></button>
                            <a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}"><i class=" ti-heart "></i></a>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

@push('styles')
<!-- <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script> -->
<!-- <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script> -->

<style>
    /* Banner Sliding */
    #Gslider .carousel-inner {
        background: #000000;
        color: black;
    }

    #Gslider .carousel-inner {
        height: 550px;
    }

    #Gslider .carousel-inner img {
        width: 100% !important;
        opacity: .8;
    }

    #Gslider .carousel-inner .carousel-caption {
        bottom: 60%;
    }

    #Gslider .carousel-inner .carousel-caption h1 {
        font-size: 50px;
        font-weight: bold;
        line-height: 100%;
        color: #F7941D;
    }

    #Gslider .carousel-inner .carousel-caption p {
        font-size: 18px;
        color: black;
        margin: 28px 0 28px 0;
    }

    #Gslider .carousel-indicators {
        bottom: 70px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
    /*==================================================================
        [ Isotope ]*/
    var $topeContainer = $('.isotope-grid');
    var $filter = $('.filter-tope-group');

    // filter items on button click
    $filter.each(function() {
        $filter.on('click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $topeContainer.isotope({
                filter: filterValue
            });
        });

    });

    // init Isotope
    $(window).on('load', function() {
        var $grid = $topeContainer.each(function() {
            $(this).isotope({
                itemSelector: '.isotope-item',
                layoutMode: 'fitRows',
                percentPosition: true,
                animationEngine: 'best-available',
                masonry: {
                    columnWidth: '.isotope-item'
                }
            });
        });
    });

    var isotopeButton = $('.filter-tope-group button');

    $(isotopeButton).each(function() {
        $(this).on('click', function() {
            for (var i = 0; i < isotopeButton.length; i++) {
                $(isotopeButton[i]).removeClass('how-active1');
            }

            $(this).addClass('how-active1');
        });
    });
</script>
<script>
    function cancelFullScreen(el) {
        var requestMethod = el.cancelFullScreen || el.webkitCancelFullScreen || el.mozCancelFullScreen || el.exitFullscreen;
        if (requestMethod) { // cancel full screen.
            requestMethod.call(el);
        } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
            var wscript = new ActiveXObject("WScript.Shell");
            if (wscript !== null) {
                wscript.SendKeys("{F11}");
            }
        }
    }

    function requestFullScreen(el) {
        // Supports most browsers and their versions.
        var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullscreen;

        if (requestMethod) { // Native full screen.
            requestMethod.call(el);
        } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
            var wscript = new ActiveXObject("WScript.Shell");
            if (wscript !== null) {
                wscript.SendKeys("{F11}");
            }
        }
        return false
    }
</script>

@endpush