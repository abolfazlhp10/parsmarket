@extends('layouts/app')
@section('title','پوستر ها')
@section('content')

@if(session()->has('success'))
<div class="container">
    <div class="alert alert-success text-center">
        {{session()->get('success')}}
    </div>
</div>
@endif


    <div class="container">
        <div class="card">
            <div class="card-header text-center fw-bold">لیست پوستر ها</div>
            <div class="card-body">

                <table class="table text-center" dir="rtl">
                    <thead>
                        <th>آیدی</th>
                        <th>نام</th>
                        <th>تصویر</th>
                        <th>یو آر ال</th>
                        <th>ویرایش</th>
                        <th>حذف</th>
                    </thead>
                    <tbody>
                        @forelse($posters as $poster)
                        <tr>
                            <td>{{$poster->id}}</td>
                            <td>{{$poster->name}}</td>
                            <td>
                                <img src="{{asset('storage/'.$poster->image)}}" width="85px" class="rounded shadow">
                            </td>
                            <td>{{$poster->url}}</td>
                            <td>
                                <a href="{{route('posters.edit',$poster->id)}}" class="btn btn-warning">
                                    ویرایش
                                </a>
                            </td>
                            <td>
                                <form action="{{route('posters.destroy',$poster->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">حدف</button>
                                </form>
                            </td>

                        </tr>
                        @empty
                        <div class="container">
                            <div class="alert alert-info" dir="rtl">
                                در حال حاضر پوستری وجود ندارد .
                            </div>
                        </div>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
