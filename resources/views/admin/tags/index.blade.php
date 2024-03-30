@extends('layouts/app')
@section('title','تگ ها')
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
            <div class="card-header text-center fw-bold">لیست تگ ها</div>
            <div class="card-body">

                <table class="table text-center" dir="rtl">
                    <thead>
                        <th>آیدی</th>
                        <th>نام</th>
                        <th>ویرایش</th>
                        <th>حذف</th>
                    </thead>
                    <tbody>
                        @forelse($tags as $tag)
                        <tr>
                            <td>{{$tag->id}}</td>
                            <td>{{$tag->name}}</td>

                            <td>
                                <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-warning">
                                    ویرایش
                                </a>
                            </td>
                            <td>
                                <form action="{{route('tags.destroy',$tag->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">حدف</button>
                                </form>
                            </td>

                        </tr>
                        @empty
                        <div class="container">
                            <div class="alert alert-info" dir="rtl">
                                در حال حاضر برچسبی وجود ندارد .
                            </div>
                        </div>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
