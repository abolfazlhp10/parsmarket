@extends('layouts/app')
@section('title','محصولات')
@section('content')

@if(session()->has('success'))
<div class="container">
    <div class="alert alert-success text-center">
        {{session()->get('success')}}
    </div>
</div>
@endif

@if(session()->has('error'))
<div class="container">
    <div class="alert alert-danger text-center">
        {{session()->get('error')}}
    </div>
</div>
@endif


    <div class="container">
        <div class="card">
            <div class="card-header text-center fw-bold">لیست محصولات</div>
            <div class="card-body">

                <table class="table text-center" dir="rtl">
                    <thead>
                        <th>آیدی</th>
                        <th>تصوير</th>
                        <th>نام</th>
                        <th>دسته بندي</th>
                        <th>قیمت</th>
                        <th>ویرایش</th>
                        <th>حذف</th>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>
                                <img src="{{asset("storage/".$product->image)}}" width="80px" class="rounded shadow">
                            </td>

                            <td>{{$product->title_fa}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{number_format($product->price)}}</td>
                            <td>
                                <a href="{{route('products.edit',$product->id)}}" class="btn btn-warning">
                                    ویرایش
                                </a>
                            </td>
                            <td>
                                <form action="{{route('products.destroy',$product->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">حدف</button>
                                </form>
                            </td>

                        </tr>
                        @empty
                        <div class="container">
                            <div class="alert alert-info" dir="rtl">
                                در حال حاضر محصولی وجود ندارد .
                            </div>
                        </div>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
