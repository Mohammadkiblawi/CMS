@extends('layouts.app')
@section('content')
<div class="col-md-8 bg-white">
    <h2 class="my-4">
        اضف موضوع جديد
    </h2>

    <form method="POST" action="{{route('post.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <select name="category_id" class="form-control">
                @include('lists.categories')
            </select>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="title" placeholder="حدد عنوان الموضوع">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="body" rows="3" placeholder=" محتوى الموضوع"></textarea>
        </div>
        <div class="from-group">
            <label for="details">اختر صورة تتعلق بالموضوع</label>
            <input class="form-control" name="image" type="file">
        </div>
        <button type="submit" class="btn btn-primary">ارسل</button>
    </form>
</div>
@include('partials.sidebar')
@endsection