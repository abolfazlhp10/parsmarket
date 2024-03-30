@extends('layouts/app')
@section('title','نظرات')
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
            <div class="card-header text-center fw-bold">لیست نظرات</div>
            <div class="card-body">

                <table class="table text-center" dir="rtl">
                    <thead>
                        <th>آیدی</th>
                        <th>كاربر</th>
                        <th>نام محصول</th>
                        <th>نظر</th>
                        <th>نوع</th>
                        <th>وضعیت</th>
                        <th>ویرایش</th>
                        <th>حذف</th>
                    </thead>
                    <tbody>
                        @forelse($comments as $comment)
                        <tr>
                            <td>{{$comment->id}}</td>

                            <td>{{$comment->user->name}}</td>

                            <td>{{$comment->product->title_fa}}</td>

                            <td>{{$comment->comment}}</td>
                            <td>
                                @if($comment->parent_id==0)
                                <span class="text-primary">نظر</span>
                                @else
                                <span class="text-danger">پاسخ</span>
                                @endif
                            </td>

                            <td>
                                @if($comment->status==0)
                                <a href="{{route('changeStatus',$comment->id)}}" class="btn btn-sm btn-outline-danger">
                                    تایید نشده
                                </a>
                                @else
                                <a href="{{route('changeStatus',$comment->id)}}" class="btn btn-sm btn-outline-success">
                                    تایید شده
                                </a>
                                @endif
                            </td>

                            <td>
                                <a href="{{route('comments.edit',$comment->id)}}" class="btn btn-warning">
                                    ویرایش
                                </a>
                            </td>
                            <td>
                                <form action="{{route('comments.destroy',$comment->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">حدف</button>
                                </form>
                            </td>

                        </tr>
                        @empty
                        <div class="container">
                            <div class="alert alert-info" dir="rtl">
                                در حال حاضر نظري وجود ندارد .
                            </div>
                        </div>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
