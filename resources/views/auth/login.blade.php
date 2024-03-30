<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
        <title>ورود</title>

    <!--font------------------------------------>
    <link rel="stylesheet" href="files/icon/css/all.min.css">

    <!--bootstrap------------------------------->
    <link rel="stylesheet" href="files/css/bootstrap.css">
    <!--owl.carousel---------------------------->
    <link rel="stylesheet" href="files/css/owl.carousel.min.css">
    <!--responsive------------------------------>
    <link rel="stylesheet" href="files/css/responsive.css">
    <!--main style------------------------------>
    <link rel="stylesheet" href="files/css/main.css">
</head>
<body>

<section class="account-box">
    <div class="register-logo">
        <a href="{{route('index')}}">
            <h2>پارس مارکت</h2>
        </a>
    </div>
    <div class="register login">
        <div class="headline">ورود به پارس مارکت</div>
        <div class="content">
            <form action="{{route('login')}}" method="POST">
                @csrf
                <label for="mobtel">ایمیل یا شماره موبایل</label>
                <input id="mobtel" type="text" name="email" class="@error('email')is-invalid @enderror" placeholder="پست الکترونیک یا شماره موبایل خود را وارد نمایید" value="@if(request()->cookie('email')) {{request()->cookie('email')}} @endif">
                @error('email')
                <span class="text-danger">
                    {{$message}}
                </span>
                @enderror
                <br>
                <label for="pwd">کلمه عبور</label>
                <input id="pwd" type="password" name="password" class="@error('password') is-invalid @enderror" placeholder="کلمه عبور خود را وارد نمایید" value="@if(request()->cookie('password')) {{request()->cookie('password')}} @endif">
                @error('password')
                <span class="text-danger">
                    {{$message}}
                </span>
                @enderror
                <div class="acc-agree">
                    <input id="chkbox" type="checkbox" name="remember" id="remember" @if(request()->cookie('password')){{'checked'}}@endif>
                    <label for="chkbox"><span>مرا به خاطر داشته باش</span></label>
                </div>
                <button type="submit"> ورود به پارس مارکت</button>
                <br>
                    <a href="{{url('google')}}" class="btn btn-danger btn-block">ورود با گوگل</a>
                <br>

            </form>
        </div>
        <div class="foot login-foot">
            <span>کاربر جدید هستید؟</span>
            <a href="{{route('register')}}">ثبت نام در پارس مارکت</a>
        </div>
    </div>
</section>

</body>
<!--jquery--------------------------------------->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--bootstrap-------------------------------->
<script src="files/js/bootstrap.js"></script>
<!--    owl.carousel----------------------------->
<script src="files/js/owl.carousel.min.js"></script>
<!--main----------------------------------------->
<script src="files/js/main.js"></script>

</html>
