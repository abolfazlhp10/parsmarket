@extends('layouts/app')
@isset($slider)
@section('title', 'ویرایش اسلایدر')
@else
@section('title', 'ایجاد اسلایدر')
@endisset
@section('content')
    <div class="card">
        <div class="card-header text-center fw-bold">
            @isset($slider)
            ویرایش اسلایدر
            @else
            ایجاد اسلایدر
            @endisset
        </div>
        <div class="card-body" dir="rtl">
            <form action="{{isset($slider)?route('sliders.update',$slider->id):route('sliders.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @isset($slider)
                @method('PUT')

                @endisset
                <div class="form-group">
                    <label for="slider">عکس اسلایدر خود را انتخاب کنید :</label>
                    <input type="file" name="image" id="slider"
                        class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                    @isset($slider)
                    <br>
                    <img src="{{asset('storage/'.$slider->image)}}" height="60%" width="20%" class="shadow rounded">
                    @endisset
                </div>

                <button type="submit" class="btn btn-block btn-primary  mt-3">
                    @isset($slider)
                    ویرایش
                    @else
                    افزودن
                    @endisset
                </button>
            </form>
        </div>
    </div>
@endsection
