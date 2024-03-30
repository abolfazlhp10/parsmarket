@extends('layouts/app')
@section('title','سفارشات')
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
            <div class="card-header text-center fw-bold">لیست سفارشات</div>
            <div class="card-body">

                <table class="table text-center" dir="rtl">
                    <thead>
                        <th>آیدی</th>
                        <th>كاربر</th>
                        <th>نام محصول</th>
                        <th>قیمت</th>
                        <th>قیمت بعد از تخفیف</th>
                        <th>تعداد</th>
                        <th>حذف</th>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>

                            <td>{{$order->user->name}}</td>

                            <td>{{$order->product->title_fa}}</td>

                            <td>{{number_format($order->price)}}</td>

                            <td>{{number_format($order->dis_price)}}</td>

                            <td>{{$order->quantity}}</td>

                            <td>
                                <form action="{{route('orders.destroy',$order->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">حدف</button>
                                </form>
                            </td>

                        </tr>
                        @empty
                        <div class="container">
                            <div class="alert alert-info" dir="rtl">
                                در حال حاضر سفارشي وجود ندارد .
                            </div>
                        </div>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
