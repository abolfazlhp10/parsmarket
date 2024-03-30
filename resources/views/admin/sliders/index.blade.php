@extends('layouts/app')
@section('title','اسلایدر ها')
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
            <div class="card-header text-center fw-bold">لیست اسلایدر ها</div>
            <div class="card-body">

                <table class="table text-center" dir="rtl">
                    <thead>
                        <th>آیدی</th>
                        <th>تصویر</th>
                        <th>ویرایش</th>
                        <th>حذف</th>
                    </thead>
                    <tbody>
                        @forelse($sliders as $slider)
                        <tr>
                            <td>{{$slider->id}}</td>
                            <td>
                                <img src="{{asset('storage/'.$slider->image)}}" width="85px" class="rounded shadow">
                            </td>
                            <td>
                                <a href="{{route('sliders.edit',$slider->id)}}" class="btn btn-warning">
                                    ویرایش
                                </a>
                            </td>
                            <td>
                                <form action="{{route('sliders.destroy',$slider->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">حدف</button>
                                </form>
                            </td>

                        </tr>
                        @empty
                        <div class="container">
                            <div class="alert alert-info" dir="rtl">
                                در حال حاضر اسلایدر وجود ندارد .
                            </div>
                        </div>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
