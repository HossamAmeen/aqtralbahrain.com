<header class="header shop">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (requires Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <!-- Header Inner -->
    <div class="header-inner head">
        <div class="container-fluid px-3">
            <div class="cat-nav-head py-2">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg d-flex justify-content-space-between" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                                <a class="navbar-brand" href="{{ route('home') }}">
                                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 50px;">
                                </a>
                                <div class="navbar-collapse">
                                    <div class="nav-inner">
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class="{{Request::path()=='home' ? 'active' : ''}}"><a href="{{route('home')}}">{{ __('application.home') }}</a></li>
                                            <li class="{{Request::path()=='about-us' ? 'active' : ''}}"><a href="{{route('about-us')}}">{{ __('application.about_us') }}</a></li>
                                            <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists')  active  @endif"><a href="{{route('product-grids')}}">{{__('application.products')}}</a></li>
                                            {{Helper::getHeaderCategory()}}
                                            <li class="{{Request::path()=='blog' ? 'active' : ''}}"><a href="{{route('blog')}}">{{__('application.blog')}}</a></li>
                                            <li class="{{Request::path()=='contact' ? 'active' : ''}}"><a href="{{route('contact')}}">{{__('application.contact_us')}}</a></li>
                                            @if(auth()->check())
                                            <li class="{{Request::path()=='contact' ? 'active' : ''}}"><a href="{{url('/user/order')}}">لوحة التحكم</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                @guest
                                <button class="btn login-register-btn">
                                    <a href="{{route('login.form')}}" class="fw-bold">
                                        {{__('application.login')}} / {{__('application.register')}}</a>
                                </button>
                                @endguest
                            </nav>
                            <!--/ End Main Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
    <!-- End Topbar -->
    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12 logo-container">

                    <div class="search-top">
                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                        <!-- Search Form -->
                        <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="Search here..." name="search">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                        <!--/ End Search Form -->
                    </div>
                    <!--/ End Search Form -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <select>
                                <option>{{__('application.all_category')}}</option>
                                @foreach(Helper::getAllCategory() as $cat)
                                <option>{{$cat->title}}</option>
                                @endforeach
                            </select>
                            <form method="POST" action="{{route('product.search')}}">
                                @csrf
                                <input name="search" placeholder="{{__('application.search_products_here')}}" type="search">
                                <button class="btnn" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="right-bar">
                        <!-- Search Form -->
                        <div class="sinlge-bar shopping">
                            @php
                            $total_prod=0;
                            $total_amount=0;
                            @endphp
                            @if(session('wishlist'))
                            @foreach(session('wishlist') as $wishlist_items)
                            @php
                            $total_prod+=$wishlist_items['quantity'];
                            $total_amount+=$wishlist_items['amount'];
                            @endphp
                            @endforeach
                            @endif
                            <a href="{{route('wishlist')}}" class="single-icon"><i class="far  fa-heart"></i> <span class="total-count">{{Helper::wishlistCount()}}</span></a>
                            <!-- Shopping Item -->
                            @auth
                            <div class="shopping-item">
                                <div class="dropdown-cart-header">
                                    <span>{{count(Helper::getAllProductFromWishlist())}} {{__('application.items')}}</span>
                                    <a href="{{route('wishlist')}}">{{__('application.view_wishlist')}}</a>
                                </div>
                                <ul class="shopping-list">
                                    {{-- {{Helper::getAllProductFromCart()}} --}}
                                    @foreach(Helper::getAllProductFromWishlist() as $data)
                                    @php
                                    $photo=explode(',',$data->product['photo']);
                                    @endphp
                                    <li>
                                        <a href="{{route('wishlist-delete',$data->id)}}" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                        <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
                                        <h4><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h4>
                                        <p class="quantity">{{$data->quantity}} x - <span class="amount">${{number_format($data->price,2)}}</span></p>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="bottom">
                                    <div class="total">
                                        <span>{{__('application.total')}}</span>
                                        <span class="total-amount">${{number_format(Helper::totalWishlistPrice(),2)}}</span>
                                    </div>
                                    <a href="{{route('cart')}}" class="btn animate">{{__('application.cart')}}</a>
                                </div>
                            </div>
                            @endauth
                            <!--/ End Shopping Item -->
                        </div>
                        {{-- <div class="sinlge-bar">
                            <a href="{{route('wishlist')}}" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                    </div> --}}
                    <div class="sinlge-bar shopping">
                        <a href="{{route('cart')}}" class="single-icon"><i class="ti-bag"></i> <span class="total-count">{{Helper::cartCount()}}</span></a>
                        <!-- Shopping Item -->
                        @auth
                        <div class="shopping-item">
                            <div class="dropdown-cart-header">
                                <span>{{count(Helper::getAllProductFromCart())}} {{__('application.items')}}</span>
                                <a href="{{route('cart')}}">{{__('application.view_cart')}}</a>
                            </div>
                            <ul class="shopping-list">
                                {{-- {{Helper::getAllProductFromCart()}} --}}
                                @foreach(Helper::getAllProductFromCart() as $data)
                                @php
                                $photo=explode(',',$data->product['photo']);
                                @endphp
                                <li>
                                    <a href="{{route('cart-delete',$data->id)}}" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                    <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
                                    <h4><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h4>
                                    <p class="quantity">{{$data->quantity}} x - <span class="amount">${{number_format($data->price,2)}}</span></p>
                                </li>
                                @endforeach
                            </ul>
                            <div class="bottom">
                                <div class="total">
                                    <span>{{__('application.total')}}</span>
                                    <span class="total-amount">${{number_format(Helper::totalCartPrice(),2)}}</span>
                                </div>
                                <a href="{{route('checkout')}}" class="btn animate">{{__('application.checkout')}}</a>
                            </div>
                        </div>
                        @endauth
                        <!--/ End Shopping Item -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</header>
<style>
    .flag-list {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
        padding: 0;
    }

    .flag-link {
        display: inline-block;
        margin: 0 5px;
        cursor: pointer;
    }

    .flag-list:hover a {
        background: transparent !important;
    }

    .flag-img {
        border-radius: 50%;
        border: 2px solid #F5F5DC;
        width: 23px;
        height: 23px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }

    .header-inner {
        background-color: #5ba051 !important;
    }


    a {
        text-decoration: none;
    }



    body {
        font-family: Thesans !important;
    }

    /* .logo  {
    position: relative !important;
    margin: 0 !important;
    width: 100px !important;
    height: 100px !important;
} */
</style>
