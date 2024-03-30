@extends('layouts/app')
@section('title','ویرایش نظر')
@section('content')
    <div class="card" dir="rtl">
        <div class="card-header text-center">ویرایش نظر</div>
        <div class="card-body">
            <form action="{{route('comments.update',$comment->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">نام :</label>
                <input type="text" value="{{$comment->user->name}}" disabled class="form-control" >
            </div>
            <br>
            <div class="form-group">
                <label for="">نظر:</label>
                <textarea class="form-control" name="comment">{{$comment->comment}}
                </textarea>
            </div>
            <br>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    ویرایش
                </button>
            </div>

            </form>
        </div>
    </div>
@endsection
