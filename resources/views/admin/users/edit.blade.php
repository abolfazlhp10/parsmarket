@extends('layouts/app')
@section('title', 'ویرایش كاربر')
@section('content')
    <div class="card">
        <div class="card-header text-center fw-bold" dir="rtl">
            ویرایش كاربر به نام {{ $user->name }}
        </div>
        <div class="card-body" dir="rtl">
            <form action="{{ route('users.update', $user->id) }}" method="post">

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">نام كاربر خود را وارد کنید :</label>
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">
                    @error('name')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <br>
                <div class="form-group">
                    <label for="email">ايميل :</label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror
                        @if (session()->has('emailExists')) is-invalid @endif
                        " value="@if(session()->has('emailExists')) {{old('email')}} @else {{ $user->email}} @endif">
                    @error('email')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                    @if (session()->has('emailExists'))
                        <span class="text-danger">
                            {{ session()->get('emailExists') }}
                        </span>
                    @endif
                </div>
                <br>


                <div class="form-group">
                    <label for="role">نقش كاربر خود را انتخاب کنید :</label>
                    <select name="role" id="role" class="form-control">
                        <option value="admin" @if ($user->role == 'admin') selected @endif>admin</option>
                        <option value="user" @if ($user->role == 'user') selected @endif>user</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-block btn-primary  mt-3">
                    ویرایش
                </button>
            </form>
        </div>
    </div>
@endsection
