@extends('layouts/app')
@isset($tag)
@section('title', 'ویرایش برچسب')
@else
@section('title', 'ایجاد برچسب')
@endisset
@section('content')
    <div class="card">
        <div class="card-header text-center fw-bold">
            @isset($tag)
            ویرایش برچسب
            @else
            ایجاد برچسب
            @endisset
        </div>
        <div class="card-body" dir="rtl">
            <form action="{{isset($tag)?route('tags.update',$tag->id):route('tags.store') }}" method="post">
                @csrf

                @isset($tag)
                @method('PUT')
                @endisset

                <div class="form-group">
                    <label for="tag">نام برچسب خود را وارد کنید :</label>
                    <input type="text" name="tag" id="tag"
                        class="form-control @error('tag') is-invalid @enderror" @isset($tag) value="{{$tag->name}}" @endisset>
                    @error('tag')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-block btn-primary  mt-3">
                    @isset($tag)
                    ویرایش
                    @else
                    افزودن
                    @endisset
                </button>
            </form>
        </div>
    </div>
@endsection
