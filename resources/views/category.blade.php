@extends('layouts/front')
@section('title', 'فروشگاه اینترنتی لرن پارس')
@section('content')

        <!--    product-slider----------------------------------->
        @if($products->count())
        <div class="col-lg-12 col-md-12 col-xs-12 pull-right">
            <div class="section-slider-product mb-4">
                <div class="widget widget-product card">
                    <header class="card-header">
                        <span class="title-one">جديدترين ها</span>
                        <h3 class="card-title">مشاهده همه</h3>
                    </header>
                    <div class="product-carousel owl-carousel owl-theme owl-rtl owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage"
                                style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2234px;">

                                @foreach($products as $product)
                                <div class="owl-item active" style="width: 309.083px; margin-left: 10px;">
                                    <div class="item">
                                        <a href="{{route('product',$product->slug)}}">
                                            <div class="stars-plp">
                                                <span class="mdi mdi-star active"></span>
                                                <span class="mdi mdi-star active"></span>
                                                <span class="mdi mdi-star active"></span>
                                                <span class="mdi mdi-star active"></span>
                                                <span class="mdi mdi-star active"></span>
                                            </div>
                                            <img src="{{asset('storage/'.$product->image)}}" class="img-fluid" alt="">
                                        </a>
                                        <h2 class="post-title">
                                            <a href="{{route('product',$product->slug)}}">
                                                {{$product->title_fa}}
                                            </a>
                                        </h2>

                                        @if($product->dis_price)
                                        <div class="price">
                                            <ins>
                                                <span>{{number_format($product->dis_price)}}<span>تومان</span></span>
                                            </ins>
                                        </div>
                                        <div class="price">
                                            <ins>
                                                <span><del class="text-light">
                                                    <div class="mb-3">
                                                        {{number_format($product->price)}}
                                                    </div>
                                                  </del></span>
                                                  <span class="badge badge-pill badge-danger">
                                                    {{$product->dis_percent."%"}}
                                                </span>
                                            </ins>
                                        </div>
                                        @else
                                        <div class="price">
                                            <ins>
                                                <span>{{number_format($product->price)}}<span>تومان</span></span>
                                            </ins>
                                        </div>
                                        @endif

                                    </div>
                                </div>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-lg-12 col-md-12 col-xs-12 pull-right mt-3">
            <div class="alert alert-light">
                در حال حاضر اين دسته بندي محصولي ندارد
            </div>
        </div>

        @endif

        <!--    product-slider------------------------->

@endsection
