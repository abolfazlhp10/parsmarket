@extends('layouts/front')
@section('title', 'سبد خريد')
@section('content')

    <section class="main-cart container">
        <div class="o-page__content">
            <div class="o-headline">
                <div id="main-cart"><span class="c-checkout-text c-checkout__tab--active">سبد خرید</span><span
                        class="c-checkout__tab-counter">{{ $basket->count() }}</span></div>
            </div>
            @if ($cartItems->count())
                <form action="{{ route('carts.removeAllCarts') }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger mb-3"><i class="fa fa-trash"></i> حذف همه</button>

                </form>
            @endif

            <div class="c-checkout">

                <ul class="c-checkout__items">
                    <li class="c-checkout__item">
                        @php
                            $sumPrice = 0;
                            $sumWithoutDiscount = 0;
                        @endphp


                        @foreach ($cartItems as $key => $product)
                            @php

                                $sumWithoutDiscount = $sumWithoutDiscount + $product->price * $product->quantity;

                                if ($product->attributes->dis_price) {
                                    $sumPrice = $sumPrice + $product->attributes->dis_price * $product->quantity;
                                } else {
                                    $sumPrice = $sumPrice + $product->price * $product->quantity;
                                }

                            @endphp


                            <div class="c-checkout__row">
                                <div class="c-checkout__col--thumb">
                                    <a href="{{ route('product', $product->attributes->slug) }}"><img
                                            src="{{ asset('storage/' . $product->attributes->image) }}" alt=""></a>
                                </div>
                                <div class="c-checkout__col--desc">
                                    <a href="{{ route('product', $product->attributes->slug) }}">{{ $product->name }}</a>
                                    <p class="c-checkout__guarantee">{{ $product->attributes->gr }}</p>
                                    <p class="c-checkout__dealer"> فروشنده: {{ $product->attributes->seller }}</p>
                                    <div class="c-checkout__variant c-checkout__variant--color"></div>
                                    <div class="c-checkout__col--information">
                                        <div class="c-checkout__col c-checkout__col--counter">
                                            <div class="c-cart-item__quantity-row">
                                                <div class="c-quantity-selector">
                                                    <form action="{{ route('carts.update') }}" method="post"
                                                        class="mr-2">
                                                        @csrf


                                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                                        <input type="hidden" name="increase">


                                                        <button type="submit">+</button>

                                                    </form>

                                                    <span>
                                                        {{ $product->quantity }}
                                                    </span>

                                                    @if ($product->quantity > 1)
                                                        <form action="{{ route('carts.update') }}" method="post"
                                                            class="ml-2">

                                                            @csrf

                                                            <input type="hidden" name="id"
                                                                value="{{ $product->id }}">
                                                            <input type="hidden" name="decrease">

                                                            <button type="submit">-</button>

                                                        </form>
                                                    @else
                                                        <form action="{{ route('carts.remove', $product->id) }}"
                                                            method="post" class="ml-2">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" class="c-quantity-selector__remove"><i
                                                                    class="fa fa-trash"></i></button>

                                                        </form>
                                                    @endif







                                                </div>
                                                <a href="#" class="c-cart-item__save-for-later"><i
                                                        class="fa fa-th-list"></i>
                                                    ذخیره در لیست خرید بعدی </a>
                                                <div class="c-checkout__quantity-error">امکان تغییر تعداد برای این کالا وجود
                                                    ندارد.</div>
                                            </div>
                                        </div>
                                        <div class="c-checkout__col c-checkout__col--price">

                                            @if ($product->attributes->dis_price)
                                                <div class="c-checkout__price c-checkout__price--del">
                                                    {{ number_format($product->price) }} تومان </div>

                                                <div class="c-checkout__price">
                                                    {{ number_format($product->attributes->dis_price) }}تومان
                                                </div>
                                                <span class="text-danger">
                                                    {{ $product->attributes->dis_percent . '%' . ' تخفیف' }}
                                                </span>
                                            @else
                                                <div class="c-checkout__price">{{ number_format($product->price) }}تومان
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="c-cart-item__stock-info"><span><i class="fa fa-bell"></i> ۴ عدد در انبار
                                            باقیست
                                            - پیش از اتمام بخرید </span></div>
                                </div>

                            </div>
                        @endforeach

                    </li>
                    <!--cart-item-->
                </ul>
                <div class="c-checkout__to-shipping-sticky">
                    @if ($sumPrice != 0)
                        <form action="{{ route('pay.request') }}" method="post">
                            @csrf
                            <button class="c-checkout__to-shipping-link">ادامه فرایند خرید</button>
                        </form>
                    @endif
                    <div class="c-checkout__to-shipping-price-report">
                        <p>مبلغ قابل پرداخت</p>
                        <div class="c-checkout__to-shipping-price-report--price">
                            {{ number_format($sumPrice) }}<span>تومان</span></div>


                    </div>
                </div>
            </div>
        </div>
        <aside class="o-page__aside">
            <div class="c-checkout-aside">
                <div class="c-checkout-summary">
                    <ul class="c-checkout-summary__summary">
                        <li>
                            <span>قیمت کالاها ({{ $basket->count() }})</span>
                            <span> {{ number_format($sumPrice) }} تومان </span>
                        </li>
                        <!--incredible-->
                        <li class="c-checkout-summary__discount">
                            <span> تخفیف کالاها </span>
                            <span class="discount-price">{{ number_format($sumWithoutDiscount - $sumPrice) }}تومان</span>
                        </li>
                        <!--incredible-->
                        <li class="has-devider">
                            <span>جمع</span>
                            <span> {{ number_format($sumPrice) }} تومان </span>
                        </li>
                        <li>
                            <span>هزینه ارسال</span>
                            <span>
                                @if ($sumPrice != 0)
                                    @if ($sumPrice > 500000)
                                        رایگان
                                    @else
                                        {{ number_format(40000) }}
                                    @endif
                                @else
                                    0
                                @endif

                            </span>
                        </li>

                        @if ($sumPrice != 0)
                            <li class="has-devider">
                                <span> مبلغ قابل پرداخت </span>
                                @if ($sumPrice > 500000)
                                    <span>{{ number_format($sumPrice) }} تومان </span>
                                    @php
                                        session()->put('totalPrice', $sumPrice);
                                    @endphp
                                @else
                                    <span>{{ number_format($sumPrice + 40000) }} تومان </span>
                                    @php
                                        session()->put('totalPrice', $sumPrice + 40000);
                                    @endphp
                                @endif

                            </li>
                        @endif

                    </ul>
                    <div class="c-checkout-summary__main">
                        <div class="c-checkout-summary__content">
                            <div><span> کالاهای موجود در سبد شما ثبت و رزرو نشده‌اند، برای ثبت سفارش مراحل بعدی را تکمیل
                                    کنید.</span></div>
                        </div>
                    </div>
                </div>
                <div class="c-checkout-feature-aside">
                    <ul>
                        <li class="c-checkout-feature-aside__item c-checkout-feature-aside__item--guarantee"><i
                                class="fa-duotone fa-box-check"></i> هفت روز
                            ضمانت
                            تعویض</li>
                        <li class="c-checkout-feature-aside__item c-checkout-feature-aside__item--cash"><i
                                class="fa-duotone fa-credit-card-front"></i> پرداخت در محل با
                            کارت بانکی</li>
                        <li class="c-checkout-feature-aside__item c-checkout-feature-aside__item--express"><i
                                class="fa-duotone fa-truck"></i> تحویل اکسپرس
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
    </section>

    <section class="cart-empty container" id="cart-sfl">
        <div class="cart-sfl__icon"></div>
        <div class="cart-empty__title" style="font-size: 2em;"> لیست خرید بعدی شما خالی است! </div>
        <div class="cart-sfl__links">
            <p>شما می‌توانید محصولاتی که به سبد خرید خود افزوده‌اید و فعلا قصد خرید آن‌ها را ندارید، در لیست خرید بعدی
                قرار
                داده و هر زمان مایل بودید آن‌ها را به سبد خرید اضافه کرده و خرید آن‌ها را تکمیل کنید. </p>
        </div>
    </section>





@endsection
