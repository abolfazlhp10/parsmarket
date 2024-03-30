@extends('layouts/app')
@isset($poster)
@section('title', 'ویرایش پوستر')
@else
@section('title', 'ایجاد پوستر')
@endisset
@section('content')
    <div class="card">
        <div class="card-header text-center fw-bold">
            @isset($poster)
            ویرایش پوستر
            @else
            ایجاد پوستر
            @endisset
        </div>
        <div class="card-body" dir="rtl">
            <form action="{{isset($poster)?route('posters.update',$poster->id):route('posters.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @isset($poster)
                @method('PUT')

                @endisset
                <div class="form-group">
                    <label for="poster">نام پوستر خود را وارد کنید :</label>
                    <input type="text" name="name" id="poster"
                        class="form-control @error('name') is-invalid @enderror" value="{{isset($poster)?$poster->name:old('name')}}">
                    @error('name')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                    <br>
                    <label for="poster">یو آر ال پوستر خود را وارد کنید :</label>
                    <input type="text" name="url" id="poster"
                        class="form-control @error('url') is-invalid @enderror" value="{{isset($poster)?$poster->url:old('url')}}" >
                    @error('url')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                    <br>
                    <label for="poster">عکس پوستر خود را انتخاب کنید :</label>
                    <input type="file" name="image" id="poster"
                        class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                    @isset($poster)
                    <br>
                    <img src="{{asset('storage/'.$poster->image)}}" height="60%" width="20%" class="shadow rounded">
                    @endisset
                </div>

                <button type="submit" class="btn btn-block btn-primary  mt-3">
                    @isset($poster)
                    ویرایش
                    @else
                    افزودن
                    @endisset
                </button>
            </form>
        </div>
    </div>
@endsection
