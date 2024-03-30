<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>



    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('files/css/adminStyle.css') }}">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="//cdn.ckeditor.com/4.24.0-lts/full/ckeditor.js"></script>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10">
                        @yield('content')
                    </div>
                    <div class="col-md-2">
                        <ul class="list-group text-center">
                            <li class="list-group-item">
                                <a href="{{route('category.index')}}" class="text-decoration-none">دسته بندی ها</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('category.create')}}" class="text-decoration-none">ایجاد دسته بندی</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('tags.index')}}" class="text-decoration-none"> برچسب ها</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('tags.create')}}" class="text-decoration-none">ایجاد برچسب</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('sliders.index')}}" class="text-decoration-none">اسلایدر</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('sliders.create')}}" class="text-decoration-none">اضافه کردن عکس به اسلایدر</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('posters.index')}}" class="text-decoration-none">لیست پوستر ها</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('posters.create')}}" class="text-decoration-none">اضافه کردن پوستر جدید</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('users.index')}}" class="text-decoration-none">ليست كاربران</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('products.index')}}" class="text-decoration-none">لیست محصولات</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('products.create')}}" class="text-decoration-none">اضافه کردن محصول</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('comments.index')}}" class="text-decoration-none">ليست نظرات</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('orders.index')}}" class="text-decoration-none">ليست سفارشات</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </main>
    </div>



</body>

</html>
