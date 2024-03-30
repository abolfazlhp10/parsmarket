<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <title>ثبت نام</title>

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
            <a href="index.html">
                <h2>پارس مارکت</h2>
            </a>
        </div>
        <div class="register">
            <div class="headline">ثبت‌نام در پارس مارکت </div>
            <div class="content">
                <span class="hint">اگر قبلا با ایمیل ثبت‌نام کرده‌اید، نیاز به ثبت‌نام مجدد با شماره همراه
                    ندارید</span>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <label for="mobtel">نام کاربری</label>
                    <input id="mobtel" type="text" name="name" placeholder="نام کاربری"
                        class="@error('name') is-invalid @enderror" value="{{old('name')}}">
                    @error('name')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                    <label for="mobtel">ایمیل</label>
                    <input id="mobtel" type="email" name="email" placeholder="ایمیل" value="{{ old('email') }}"
                        class="@error('email') is-invalid @enderror">
                    @error('email')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                    <label for="pwd">رمز عبور</label>
                    <input id="pwd" type="password" name="password" placeholder="رمز عبور"
                        class="@error('email')is-invalid @enderror">
                    @error('password')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                    <label for="pwd">تایید رمز عبور</label>
                    <input id="pwd" type="password" name="password_confirmation" placeholder="تایید رمز عبور">
                    <div class="acc-agree">
                        <label for="chkbox">
                            <input id="chkbox" type="checkbox" name="privacy"
                                class="@error('privacy') is-invalid @enderror" @if(old('privacy')=='on') checked @endif>
                            <a href="#">حریم خصوص</a>
                            <span>و</span>
                            <a href="#">شرایط و قوانین</a>
                            <span> استفاده از سرویس های سایت پارس مارکت را مطالعه نموده و با کلیه موارد آن
                                موافقم.</span>
                        </label>
                    </div>
                    @error('privacy')
                        <span class="text-danger mb-3">
                            لطفا ابتدا شرایط و قوانین را قبول کنید.
                        </span>
                    @enderror
                    <button type="submit">ثبت نام در پارس مارکت</button>
                </form>
            </div>
            <div class="foot">
                <div>
                    <span>قبلا در پارس مارکت ثبت‌نام کرده‌اید؟</span>
                    <a href="{{ route('login') }}">وارد شوید</a>
                </div>
            </div>
        </div>
    </section>

    <br><br>

</body>
<!--jquery--------------------------------------->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--bootstrap-------------------------------->
<script src="files/js/bootstrap.js"></script>
<!--    owl.carousel----------------------------->
<script src="files/js/owl.carousel.min.js"></script>
<!--main----------------------------------------->
<script src="files/js/main.js"></script>

</html>
