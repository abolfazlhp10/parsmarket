@extends('layouts/app')
@section('title','کاربران')
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
            <div class="card-header text-center fw-bold">لیست کاربران</div>
            <div class="card-body">

                <table class="table text-center" dir="rtl">
                    <thead>
                        <th>آیدی</th>
                        <th>تصوير</th>
                        <th>نام</th>
                        <th>ایمیل</th>
                        <th>نقش کاربری</th>
                        <th>ویرایش</th>
                        <th>حذف</th>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>
                                <img src="{{Gravatar::get($user->email,['size'=>40])}}" alt="{{$user->name}}" class="rounded-circle">
                            </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role}}</td>

                            <td>
                                <a href="{{route('users.edit',$user->id)}}" class="btn btn-warning">
                                    ویرایش
                                </a>
                            </td>
                            <td>
                                <form action="{{route('users.destroy',$user->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">حدف</button>
                                </form>
                            </td>

                        </tr>
                        @empty
                        <div class="container">
                            <div class="alert alert-info" dir="rtl">
                                در حال حاضر کاربران وجود ندارد .
                            </div>
                        </div>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
