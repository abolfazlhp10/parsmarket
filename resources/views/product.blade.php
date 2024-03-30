@extends('layouts/front')
@section('content')
    <!--single-product----------------------------->
    <div class="container-main">
        <div class="col-12">
            <div class="breadcrumb-container">
                <ul class="js-breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('index') }}" class="breadcrumb-link">خانه</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#" class="breadcrumb-link">{{ $product->category->name }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link active-breadcrumb">{{ $product->title_fa }}</a>
                    </li>
                </ul>
            </div>

            @if (session()->has('successComment'))
                <div class="col-lg-6 col-xs-12 pull-right">
                    <div class="alert alert-success">
                        {{ session()->get('successComment') }}
                    </div>
                </div>
            @endif

            @if (session()->has('succSendReply'))
                <div class="col-lg-6 col-xs-12 pull-right">
                    <div class="alert alert-success">
                        {{ session()->get('succSendReply') }}
                    </div>
                </div>
            @endif
            <article class="product">
                <div class="col-lg-4 col-xs-12 pb-5 pull-right">
                    <!-- Product Options-->
                    <div class="product-gallery">
                        <div>
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product" class="img-pro">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-xs-12 pull-right">
                    @if (session()->has('success'))
                        <div class="container">
                            <div class="col-md-10">
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            </div>
                        </div>
                    @endif
                    <section class="product-info">
                        <div class="product-headline">
                            <h1 class="product-title">
                                {{ $product->title_fa }}
                                <span class="product-title-en">{{ $product->title_en }}</span>
                            </h1>
                        </div>
                        <div class="product-attributes">
                            <div class="col-lg-6 col-xs-12 pull-right">
                                <div class="product-config">
                                    <div class="product-config-wrapper">
                                        <div class="product-directory">
                                            <ul>
                                                <li>
                                                    <span>برند</span>
                                                    :
                                                    <a href="#" class="product-brand-title">{{ $product->brand }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                        @php
                                            $ex = explode('-', $product->options);
                                        @endphp
                                        <div class="product-params">
                                            <ul>ویژگی‌های محصول
                                                @foreach ($ex as $value)
                                                    <li>
                                                        {{ $value }}
                                                    </li>
                                                @endforeach

                                                <li class="product-params-more-handler">
                                                    <a href="#" class="more-attr-button">
                                                        <span class="show-more">+ موارد بیشتر</span>
                                                        <span class="show-less">- بستن</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-xs-12 pull-left">
                                <div class="product-summary">
                                    <div class="product-seller-info">
                                        <div class="seller-info-changable">
                                            <div class="product-seller-row vendor">
                                                <span class="title"> فروشنده:</span>
                                                <a href="#" class="product-name">{{ $product->seller }}</a>
                                            </div>
                                            <div class="product-seller-row guarantee">
                                                <span class="title"> گارانتی:</span>
                                                <a href="#" class="product-name">{{ $product->gr }}</a>
                                            </div>
                                            <div class="product-seller-row guarantee">
                                                <span class="title"> تعداد:</span>
                                                <a href="#" class="product-name">3</a>
                                            </div>
                                            <div class="product-seller-row price last_item">
                                                <div class="product-seller-price-info price-value mb-3">
                                                    <span class="title"> قیمت:</span>
                                                </div>
                                                <div class="product-seller-price-info price-value mb-3">
                                                    <span class="amount text-danger">
                                                        @if ($product->dis_price)
                                                            <del class="text-danger">
                                                                {{ number_format($product->price) }}
                                                            </del>
                                                            <div class="badge badge-pill badge-danger mr-3">
                                                                {{ $product->dis_percent . '%' }}</div>


                                                            <div>
                                                                {{ number_format($product->dis_price) }}
                                                                <span>تومان</span>
                                                            </div>
                                                        @else
                                                            {{ number_format($product->price) }}
                                                            <span>تومان</span>
                                                        @endif


                                                    </span>
                                                </div>
                                            </div><br>
                                            <div class="parent-btn">
                                                <form action="{{ route('cart.store', $product->id) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="dk-btn dk-btn-info at-c as-c">
                                                        افزودن به سبد خرید
                                                    </button>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </article>
        </div>
        <!--    product-slider----------------------------------->
        <div class="col-lg-12 col-md-12 col-xs-12 pull-right">
            <div class="section-slider-product mb-4 mt-3">
                <div class="widget widget-product card">
                    <header class="card-header">
                        <span class="title-one">كالاهاي مشابه</span>
                        <h3 class="card-title">مشاهده همه</h3>
                    </header>
                    <div class="product-carousel owl-carousel owl-theme owl-rtl owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage"
                                style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1493px;">
                                @foreach ($similars as $product)
                                    <div class="owl-item active" style="width: 203.25px; margin-left: 10px;">
                                        <div class="item">
                                            <a href="{{ route('product', $product->slug) }}">
                                                <div class="stars-plp">
                                                    <span class="mdi mdi-star active"></span>
                                                    <span class="mdi mdi-star active"></span>
                                                    <span class="mdi mdi-star active"></span>
                                                    <span class="mdi mdi-star active"></span>
                                                    <span class="mdi mdi-star active"></span>
                                                </div>
                                                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid">
                                            </a>
                                            <h2 class="post-title">
                                                <a href="{{ route('product', $product->slug) }}">
                                                    {{ $product->title_fa }}
                                                </a>
                                            </h2>
                                            @if ($product->dis_price)
                                                <del class="text-danger">
                                                    {{ number_format($product->price) }}
                                                </del>
                                                <div class="badge badge-pill badge-danger mr-3">
                                                    {{ $product->dis_percent . '%' }}</div>


                                                <div class="text-primary">
                                                    {{ number_format($product->dis_price) }}
                                                    <span>تومان</span>
                                                </div>
                                            @else
                                                <div class="price">
                                                    <ins>
                                                        <span>{{ number_format($product->price) }}<span>تومان</span></span>
                                                    </ins>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="owl-nav"><button type="button" role="presentation" class="owl-prev disabled"><i
                                    class="fa fa-angle-right"></i></button><button type="button" role="presentation"
                                class="owl-next"><i class="fa fa-angle-left"></i></button></div>
                        <div class="owl-dots disabled"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--    product-slider------------------------->
        <div class="col-12">
            <div class="tabs mt-4 pt-3 mb-5">
                <div class="tabs-product">
                    <div class="tab-wrapper">
                        <ul class="box-tabs">
                            <li class="box-tabs-tab tabs-active">
                                <p class="box-tab-item">
                                    <i class="mdi mdi-glasses"></i>
                                    نقد و بررسی
                                </p>
                            </li>

                            <li class="box-tabs-tab">
                                <p class="box-tab-item">
                                    <i class="mdi mdi-comment-question-outline"></i>
                                    پرسش و پاسخ
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="tabs-content">
                        <div class="content-expert">
                            <section class="tab-content-wrapper" style="display:block;">
                                <article>
                                    <h2 class="params-headline">نقد و بررسی
                                        <span>{{ $product->title_en }}</span>
                                    </h2>
                                    <section class="content-expert-summary">
                                        <div class="mask pm-3">
                                            <div class="mask-text">
                                                <p>{{ $product->body }}</p>
                                            </div>
                                            <a href="#" class="mask-handler">
                                                <span class="show-more">+ ادامه مطلب</span>
                                                <span class="show-less">- بستن</span>
                                            </a>
                                            <div class="shadow-box"></div>
                                        </div>
                                    </section>


                                </article>
                            </section>


                            <section class="tab-content-wrapper">
                                @auth
                                    <div class="faq-headline">
                                        نظرات
                                        <span>نظر خود را درمورد محصول مطرح فرمایید</span>
                                    </div>

                                    <form action="{{ route('comment') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <div class="form-faq">
                                            <div class="form-faq-row mt-3">
                                                <div class="form-faq-col">
                                                    <div class="ui-textarea">
                                                        <textarea title="متن سوال" class="ui-textarea-field" name="comment"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-faq-row mt-3">
                                                <div class="form-faq-col form-faq-col-submit">
                                                    <button type="submit" class="btn-tertiary">ثبت نظر</button>
                                                </div>

                                            </div>
                                        </div>

                                    </form>

                                    <div id="product-questions-list">
                                        @forelse ($comments as $comment)
                                            <div class="questions-list">
                                                <ul class="faq-list">
                                                    <li class="is-question">
                                                        <div class="section">
                                                            <div class="faq-header">
                                                                <span class="icon-faq">
                                                                    <img src="{{ Gravatar::get($comment->user->email, ['size' => 50]) }}"
                                                                        class="rounded-circle">
                                                                </span>
                                                                <p class="h5">
                                                                    <span>{{ $comment->user->name }}</span>
                                                                </p>
                                                                <br>
                                                                <br>
                                                            </div>
                                                            <p>{{ $comment->comment }}</p>
                                                            <div class="faq-date">
                                                                <em>{{ $comment->created_at->diffForHumans() }}</em>
                                                            </div>
                                                            @if (auth()->user()->role == 'admin')


                                                                    <div>
                                                                        <button class="js-add-answer-btn">به این پرسش پاسخ دهید</button>
                                                                        <br>
                                                                    </div>


                                                            @endif
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            @if ($comment->replies->count())
                                                @foreach ($responses as $response)
                                                    <div class="questions-list answer-questions">
                                                        <ul class="faq-list">
                                                            <li class="is-question">
                                                                <div class="section">
                                                                    <div class="faq-header">
                                                                        <span class="icon-faq">
                                                                            <img src="{{ Gravatar::get($comment->user->email, ['size' => 50]) }}"
                                                                                class="rounded-circle">
                                                                        </span>
                                                                        <p class="h5">
                                                                            پاسخ :
                                                                            <span>{{ $response->user->name }}</span>
                                                                        </p>
                                                                    </div>
                                                                    <p>{{ $response->comment }}</p>
                                                                    <div class="faq-date">
                                                                        <em>{{ $response->created_at->diffForHumans() }}</em>
                                                                    </div>

                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endforeach
                                            @endif

                                        @empty
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                            <div class="alert alert-light">
                                        در حال حاضر نظری برای این محصول ثبت نشده است
                                            </div>
                                        @endforelse


                                    </div>

                                </section>
                            @else
                                <div class="alert alert-light">
                                    برای ثبت نظر ابتدا وارد حساب کاربری خود شوید <a href="{{ route('login') }}">ورود</a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--single-product----------------------------->


    <script>
              const replayButtons = document.querySelectorAll('.js-add-answer-btn');

        replayButtons.forEach(item => {
            item.addEventListener('click', () => {
                item.parentElement.insertAdjacentHTML('beforeend', `
    @if($comments->count())
        <form action="{{route('sendReply',$comment->id)}}" method="post">
            @csrf
                <input type="hidden" name="product_id" value="{{$comment->product_id}}">

                <textarea name="reply"  placeholder="پاسخ خود را بنویسید : " class="form-control" required></textarea>
                <br>
                <button type="submit" class="btn btn-primary">
                        ثبت
                </button>
        </form>
    @endif

                `);
            });
        })
    </script>
@endsection
{{--
<form action="" method="post">
    <textarea name="reply"  placeholder="پاسخ خود را بنویسید : " class="form-control"></textarea>
    <button type="submit" class="btn btn-primary">
        ثبت
    </button>
</form> --}}


