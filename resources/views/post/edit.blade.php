@extends('layouts.app')
@section('content')
<div class="col-md-8 bg-white">
    <h2 class="my-4">
        اضف موضوع جديد
    </h2>

    <form method="POST" action="{{route('post.update',$post->id)}}" enctype="multipart/form-data">
        @csrf
        @method ('patch')
        <div class="form-group">
            <select name="category_id" class="form-control">
                @include('lists.categories')
            </select>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="title" placeholder="حدد عنوان الموضوع" value="{{$post->title}}">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="body" rows="3" placeholder=" محتوى الموضوع">{{$post->body}}</textarea>
        </div>
        <div class="from-group">
            <label for="details">اختر صورة تتعلق بالموضوع</label>
            <img name="image" class="form-contol w-25 h-25" src="{{$post->image_path}}">
            <input class="form-control" name="image" type="file">
        </div>
        <button type="submit" class="btn btn-primary">تحديث</button>
    </form>
</div>
@include('partials.sidebar')
@endsection