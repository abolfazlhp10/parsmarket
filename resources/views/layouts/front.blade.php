<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
        <title>@yield("title")</title>

    <!--font------------------------------------>
    <link rel="stylesheet" href="{{asset('files/icon/css/all.min.css')}}">

    <!--bootstrap------------------------------->
    <link rel="stylesheet" href="{{asset('files/css/bootstrap.css')}}">
    <!--owl.carousel---------------------------->
    <link rel="stylesheet" href="{{asset('files/css/owl.carousel.min.css')}}">
    <!--responsive------------------------------>
    <link rel="stylesheet" href="{{asset('files/css/responsive.css')}}">
    <!--main style------------------------------>
    <link rel="stylesheet" href="{{asset('files/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('files/css/main.cart.css')}}">
</head>

<body>
    <!--header------------------------------------->
    <header>
        <div class="container-main">
            <div class="col-lg-8 col-md-8 col-xs-12 pull-right">
                <div class="header-right">
                    <div class="logo">
                        <a href="{{route('index')}}">
                            <h2 style="margin-top: 10px;">پارس مارکت</h2>
                        </a>
                    </div>
                    <div class="col-lg-9 col-md-9 col-xs-12 pull-right">
                        <div class="search-header">
                            <form action="{{route('search')}}" method="GET">
                                <input type="text" class="search-input"
                                    placeholder="نام کالا، برند و یا دسته مورد نظر خود را جستجو کنید…" name="q" value="{{request()->query('q')}}" required>
                                <button type="submit" class="button-search">
                                    <img src="{{asset('/files/images/search.png')}}">
                                </button>
                            </form>
                            <div class="search-result">
                                <ul class="search-result-list mb-0">
                                    <li>
                                        <a href="#"><i class="mdi mdi-clock-outline"></i>
                                            فروشگاه ها
                                            <button class="btn btn-light btn-remove-search" type="submit">
                                                <i class="fa-duotone fa-close"></i>
                                            </button>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="mdi mdi-clock-outline"></i>
                                            محصولات
                                            <button class="btn btn-light btn-remove-search" type="submit">
                                                <i class="fa-duotone fa-close"></i>
                                            </button>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="mdi mdi-clock-outline"></i>
                                            کالای دیجیتال
                                            <button class="btn btn-light btn-remove-search" type="submit">
                                                <i class="fa-duotone fa-close"></i>
                                            </button>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="mdi mdi-clock-outline"></i>
                                            ثبت فروشگاه
                                            <button class="btn btn-light btn-remove-search" type="submit">
                                                <i class="fa-duotone fa-close"></i>
                                            </button>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="mdi mdi-clock-outline"></i>
                                            ظروف
                                            <button class="btn btn-light btn-remove-search" type="submit">
                                                <i class="fa-duotone fa-close"></i>
                                            </button>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12 pull-left">
                <div class="header-left">
                    <ul class="nav-lr">
                        {{-- show user profile --}}
                        @auth
                        <li class="nav-item-account">
                            <a href="#">
                                <img src="{{asset('/files/images/user.png')}}" alt="user">
                                {{auth()->user()->name}}
                                <div class="dropdown-menu">
                                    <ul>
                                        <li class="dropdown-menu-item">
                                            <form action="{{route('logout')}}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item text-light">
                                                    <i class="mdi mdi-account-card-details-outline"></i>
                                                  خروج
                                                </button>
                                            </form>

                                        </li>
                                    </ul>
                                </div>
                            </a>
                        </li>
                        @else
                                <a href="{{route('login')}}" class="text-light">
                                    <i class="mdi mdi-account-card-details-outline"></i>
                                    ورود
                                </a>
                                <span class="text-light"> / </span>
                                <a href="{{route('register')}}" class="text-light">
                                    <i class="mdi mdi-logout-variant"></i>
                                    ثبت نام
                                </a>
                        @endauth
                    </ul>
                </div>
            </div>
            <div class="overlay-search-box"></div>
        </div>
        <!--        menu------------------------------->
        <nav class="main-menu">
            <div class="container-main">
                <div>
                    <ul class="list-menu">
                        <li class="item-list-menu megamenu">
                            <a href="{{route('index')}}" class="list-category"> خانه</a>
                        </li>
                        @foreach($categories as $category)
                        <li class="item-list-menu megamenu lp-drop">
                            <a href="
                            @if($category->parents()->count())
                            #
                            @else
                            {{$category->id}}
                            @endif

                            ">
                            {{$category->name}}

                            @if($category->parents()->count())
                                <i class="fa fa-angle-down" style="font-size: 12px"></i>
                            @endif
                            </a>
                            @if($category->parents()->count())
                            <div class="dropdown-menu dlp-menu"><a href="#">
                                </a>
                                <ul><a href="#">
                                    </a>
                                    <li>
                                        <a href="#">
                                        </a>
                                        @foreach($category->parents as $parent)
                                        <a href="{{route('category',$parent->name)}}" class="dropdown-item">
                                            <i class="mdi mdi-account-card-details-outline"></i>
                                            {{$parent->name}}
                                        </a>
                                        @endforeach
                                    </li>
                                </ul>
                            </div>
                            @endif
                        </li>
                        @endforeach

                        <li class="item-list-menu megamenu">
                            <a href="#" class="list-category">درباره ما</a>
                        </li>
                        <li class="item-list-menu megamenu">
                            <a href="#" class="list-category">تماس با ما</a>
                        </li>
                        @auth
                        <li class="nav-item-account nav-item-cart">
                            <a href="{{route('cart')}}">
                                <i class="fa-duotone fa-basket-shopping-simple"></i>
                                سبد خرید
                                <span class="count">{{$basket->count()}}</span>
                            </a>
                            <div class="dropdown-menu-cart">
                                <div class="dropdown-header">
                                    <a href="{{route('cart')}}" class="view-cart">مشاهده سبد خرید</a>
                                </div>
                                <div class="wrapper">
                                    <div class="scrollbar" id="style-1">
                                        <div class="force-overflow">
                                            <ul class="dropdown-list">
                                                @foreach($basket as $product)
                                                <a href="{{route('product',$product->id)}}">
                                                    <li class="dropdown-item">
                                                        <div class="title-cart">
                                                            <a href="{{route('product',$product->slug)}}">
                                                                <img src="{{asset('storage/'.$product->image)}}">
                                                            </a>
                                                            <a href="{{route('product',$product->slug)}}">
                                                                <h3>{{$product->title_fa}}</h3>
                                                            </a>
                                                            <div class="price">{{number_format($product->price)}}
                                                                <span>تومان</span>
                                                            </div>
                                                            <button class="btn-delete">
                                                                <span class="mdi mdi-close"></span>
                                                            </button>
                                                        </div>
                                                    </li>
                                                </a>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer-dropdown">

                                    <a href="{{route('cart')}}" class="checkout">تسویه حساب</a>
                                </div>
                            </div>
                        </li>
                        @else
                        @endauth
                    </ul>
                </div>
            </div>
            <div class="nav-btn nav-slider">
                <span class="linee1"></span>
                <span class="linee2"></span>
                <span class="linee3"></span>
            </div>
        </nav>
        <!--        menu------------------------------->

        <!--    menu-responsiver----------------------->
        <nav class="sidebar">
            <div class="nav-header">
                <!--              <img class="pic-header" src="images/header-pic.jpg" alt="">-->
                <div class="header-cover"></div>
                <div class="logo-wrap">
                    <a class="logo-icon" href="#"><img alt="logo-icon" src="files/images/cryptonlogo.svg"
                            width="40"></a>
                </div>
            </div>
            <ul class="nav-categories ul-base">
                <li><a href="#">فروشگاه</a></li>
                <li><a href="#">محصولات</a></li>
                <li><a href="#">ثبت فروشگاه</a></li>
                <li><a href="#">مقالات</a></li>
                <li><a href="#">درباره ما</a></li>
                <li><a href="#">تماس با ما</a></li>
            </ul>
        </nav>
        <div class="overlay"></div>
        <!--    menu-responsiver----------------------->

    </header>
    <div class="nav-categories-overlay"></div>
    <!--header------------------------------------->
        @yield('content')

    @if(!request()->is('search'))
    <!--footer------------------------------------->
    <footer class="footer mt-3">
        <div class="row">
            <div class="footer-jumpup">
                <div class="container">
                    <a href="#">
                        <span href="#" class="footer-jumpup-container"><i class="fa fa-angle-up"></i></span>
                    </a>
                </div>
            </div>
        </div>
        <article class="container-main">
            <div class="footer-more-info">
                <div class="footer-description-content">
                    <div class="col-xs-8 col-md-8 col-xs-12 pull-right">
                        <div class="footer-content">
                            <article class="footer-seo mt-3">
                                <h1>فروشگاه اینترنتی پارس مارکت، بررسی، انتخاب و خرید آنلاین</h1>
                                <p>پارس مارکت به عنوان یکی از قدیمی‌ترین فروشگاه های اینترنتی با بیش از یک دهه تجربه،
                                    با پایبندی به سه اصل، پرداخت در محل، 7 روز ضمانت بازگشت کالا و تضمین اصل‌بودن کالا
                                    موفق شده تا همگام با فروشگاه‌های معتبر جهان، به بزرگ‌ترین فروشگاه اینترنتی ایران
                                    تبدیل شود. به محض ورود به سایت پارس مارکت با دنیایی از کالا رو به رو می‌شوید! هر
                                    آنچه که نیاز دارید و به ذهن شما خطور می‌کند در اینجا پیدا خواهید کرد.</p>
                            </article>
                        </div>
                        <div class="footer-community">
                            <div class="footer-social mb-4 mt-4">
                                <span>پارس مارکت را در شبکه‌های اجتماعی دنبال کنید:</span>
                                <div class="footer-social">
                                    <ul class="footer-ul-social">
                                        <li class="footer-social-item">
                                            <a href="#" class="footer-social-link">
                                                <i class="fa-brands fa-instagram"></i>
                                            </a>
                                        </li>
                                        <li class="footer-social-item">
                                            <a href="#" class="footer-social-link">
                                                <i class="fa-brands fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="footer-social-item">
                                            <a href="#" class="footer-social-link">
                                                <i class="fa-brands fa-whatsapp"></i>
                                            </a>
                                        </li>
                                        <li class="footer-social-item">
                                            <a href="#" class="footer-social-link">
                                                <i class="fa-brands fa-telegram"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="col-lg-4 col-md-4 col-xs-12 pull-left">
                            <aside>
                                <ul class="footer-safety-partner mt-4 pull-left">
                                    <li class="footer-safety-partner-1">
                                        <a href="#">
                                            <img src="{{asset('/files/images/L-2.png')}}">
                                        </a>
                                    </li>
                                    <li class="footer-safety-partner-1">
                                        <a href="#">
                                            <img src="{{asset('/files/images/L-1.png')}}">
                                        </a>
                                    </li>
                                </ul>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="footer-copyright-text">
                    استفاده از مطالب فروشگاه اینترنتی پارس مارکت فقط برای مقاصد غیرتجاری و با ذکر منبع
                    بلامانع است. کلیه حقوق این سایت متعلق به شرکت نوآوران فن آوازه (فروشگاه آنلاین پارس مارکت) می‌باشد.
                </div>
            </div>
        </article>
    </footer>
    <!--footer------------------------------------->
    @endif
</body>
<!--jquery--------------------------------------->
<script src="{{asset('files/js/jquery.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!--bootstrap-------------------------------->
<script src="{{asset('files/js/bootstrap.js')}}"></s>
<!--    owl.carousel----------------------------->
<script src="{{asset("files/js/owl.carousel.min.js")}}"></script>
<script src="{{asset("files/js/owl.carousel.js")}}"></script>
<!--main----------------------------------------->
<script src="{{asset("files/js/main.js")}}"></script>

</html>
