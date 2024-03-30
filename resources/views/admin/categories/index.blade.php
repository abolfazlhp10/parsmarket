@extends('layouts/app')
@section('title','دسته بندی ها')
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
            <div class="card-header text-center fw-bold">لیست دسته بندی ها</div>
            <div class="card-body">

                <table class="table text-center" dir="rtl">
                    <thead>
                        <th>آیدی</th>
                        <th>نام</th>
                        <th>نوع</th>
                        <th>ویرایش</th>
                        <th>حذف</th>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>
                                @if($category->parent_id==0)
                                <span class="text-primary">
                                    دسته بندی اصلی
                                </span>
                                @else
                                <span class="text-info">
                                    زیر منو
                                </span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('category.edit',$category->id)}}" class="btn btn-warning">
                                    ویرایش
                                </a>
                            </td>
                            <td>
                                <form action="{{route('category.destroy',$category->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">حدف</button>
                                </form>
                            </td>

                        </tr>
                        @empty
                        <div class="container">
                            <div class="alert alert-info" dir="rtl">
                                در حال حاضر دسته بندی وجود ندارد .
                            </div>
                        </div>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
