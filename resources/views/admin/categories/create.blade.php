@extends('layouts/app')
@isset($category)
@section('title', 'ویرایش دسته بندی')
@else
@section('title', 'ایجاد دسته بندی')
@endisset
@section('content')
    <div class="card">
        <div class="card-header text-center fw-bold">
            @isset($category)
            ویرایش دسته بندی
            @else
            ایجاد دسته بندی
            @endisset
        </div>
        <div class="card-body" dir="rtl">
            <form action="{{isset($category)?route('category.update',$category->id):route('category.store') }}" method="post">
                @csrf
                @isset($category)
                @method('PUT')

                @endisset
                <div class="form-group">
                    <label for="category">نام دسته بندی خود را وارد کنید :</label>
                    <input type="text" name="category" id="category"
                        class="form-control @error('category') is-invalid @enderror" @isset($category) value="{{$category->name}}" @endisset>
                    @error('category')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="parent_id">نوع دسته بندی را انتخاب کنید :</label>
                    <select type="text" name="parent_id" class="form-control" id="parent_id">
                        <option value="0">دسته بندی اصلی</option>
                        @foreach($categories as $cat)
                        <option value="{{$cat->id}}" @if(isset($category))
                            @if($category->parent_id==$cat->id)
                            selected
                            @endif
                            @endif>{{$cat->name}}</option>
                        @endforeach

                    </select>
                </div>
                <button type="submit" class="btn btn-block btn-primary  mt-3">
                    @isset($category)
                    ویرایش
                    @else
                    افزودن
                    @endisset
                </button>
            </form>
        </div>
    </div>
@endsection
