@extends('layouts/app')
@isset($product)
    @section('title', 'ویرایش محصول')
@else
@section('title', 'ایجاد محصول')
@endisset
@section('content')
<div class="card">
    <div class="card-header text-center fw-bold">
        @isset($product)
            ویرایش محصول
        @else
            ایجاد محصول
        @endisset
    </div>
    <div class="card-body" dir="rtl">
        <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @isset($product)
                @method('PUT')
            @endisset
            <div class="form-group">

                <label for="title_fa">عنوان محصول خود را به فارسي وارد کنید :</label>
                <input type="text" name="title_fa" id="title_fa"
                    class="form-control mt-3 @error('title_fa') is-invalid @enderror"
                    value="{{ isset($product) ? $product->title_fa : old('title_fa') }}">
                @error('title_fa')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
                <br>
                <label for="title_en">عنوان محصول خود را به انگليسي وارد کنید :</label>
                <input type="text" name="title_en" id="title_en"
                    class="form-control mt-3 @error('title_en') is-invalid @enderror"
                    value="{{ isset($product) ? $product->title_en : old('title_en') }}">
                @error('title_en')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
                <br>

                <label for="category_id">دسته بندي محصول :</label>
                <select name="category_id" id="category_id" class="form-control mt-3">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <br>

                <label for="brand">برند محصول :</label>
                <input type="text" name="brand" id="brand"
                    class="form-control mt-3 @error('brand') is-invalid @enderror" @isset($product) value="{{$product->brand}}" @endisset>
                @error('brand')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
                <br>


                <label for="price">قيمت محصول خود را وارد کنید :</label>
                <input type="text" name="price" id="price"
                    class="form-control mt-3 @error('price') is-invalid @enderror"
                    value="{{ isset($product) ? $product->price : old('price') }}">
                @error('price')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
                <br>


                <label for="dis_price">قيمت محصول خود بعد از تخفيف را وارد کنید :</label>
                <input type="text" name="dis_price" id="dis_price" placeholder="نكته : در صورتي كه محصول تخفيف ندارد در اين قسمت چيزي ننويسيد"
                    class="form-control mt-3 @error('dis_price') is-invalid @enderror"
                    value="{{ isset($product) ? $product->dis_price : old('dis_price') }}">
                @error('dis_price')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
                <br>


                <label for="seller">نام فروشنده محصول خود را وارد کنید :</label>
                <input type="text" name="seller" id="seller"
                    class="form-control mt-3 @error('seller') is-invalid @enderror"
                    value="{{ isset($product) ? $product->seller : old('seller') }}">
                @error('seller')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
                <br>


                <label for="gr">گارانتي محصول خود را وارد کنید :</label>
                <input type="text" name="gr" id="gr"
                    class="form-control mt-3 @error('gr') is-invalid @enderror"
                    value="{{ isset($product) ? $product->gr : old('gr') }}">
                @error('gr')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
                <br>
                <div class="form-group">
                    <label for="options">ويژگي هاي محصول :</label>
                    <textarea name="options" id="options" cols="5" rows="5"
                        class="form-control mt-3 @error('options') is-invalid @enderror">@isset($product) {{$product->options}} @endisset</textarea>

                    @error('options')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <br>


                <div class="form-group">
                    <label for="body">توضيحات :</label>
                    <textarea name="body" id="body" cols="5" rows="5"
                        class="form-control mt-3 @error('body') is-invalid @enderror">@isset($product){{$product->body}} @endisset</textarea>
                        <script>
                            CKEDITOR.replace('body',{
                                language:'fa'
                            });
                        </script>

                    @error('body')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <br>





                <label for="product">عکس محصول خود را انتخاب کنید :</label>
                <input type="file" name="image" id="product"
                    class="form-control mt-3 @error('image') is-invalid @enderror">
                @error('image')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
                @isset($product)
                    <br>
                    <img src="{{ asset('storage/' . $product->image) }}" height="60%" width="20%"
                        class="shadow rounded">
                @endisset
            </div>

            <button type="submit" class="btn btn-block btn-primary  mt-3">
                @isset($product)
                    ویرایش
                @else
                    افزودن
                @endisset
            </button>
        </form>
    </div>
</div>
@endsection
